<?php

namespace Nemundo\Process\App\Task\Com\Container;


use Nemundo\Admin\Com\Table\AdminClickableTable;
use Nemundo\Admin\Com\Table\Header\UpDownSortingHyperlink;
use Nemundo\Admin\Parameter\SortingParameter;
use Nemundo\Com\Html\Hyperlink\SiteHyperlink;
use Nemundo\Admin\Com\Table\AdminTableHeader;
use Nemundo\Html\Paragraph\Paragraph;
use Nemundo\Package\Bootstrap\Table\BootstrapClickableTableRow;
use Nemundo\Package\FontAwesome\Icon\CheckIcon;
use Nemundo\Package\FontAwesome\Icon\PlusIcon;
use Nemundo\Process\App\Task\Com\Form\TaskSearchForm;
use Nemundo\Process\App\Task\Data\TaskIndex\TaskIndexCount;
use Nemundo\Process\App\Task\Data\TaskIndex\TaskIndexReader;
use Nemundo\Process\App\Task\Filter\TaskFilter;
use Nemundo\Process\Content\Com\Container\AbstractParentContainer;
use Nemundo\Process\Content\Parameter\ChildParameter;
use Nemundo\Process\Content\Parameter\ParentParameter;
use Nemundo\Process\Template\Content\Source\Add\ChildAddContentType;
use Nemundo\Process\Template\Site\ChildRemoveSite;
use Nemundo\Process\Workflow\Parameter\StatusParameter;
use Nemundo\Web\Site\Site;
use Nemundo\Workflow\Com\TrafficLight\DateTrafficLight;

class TaskParentContainer extends AbstractParentContainer
{


    public $showSearchForm = false;

    //editable
    // showAddRemoveButton
    public $showAddButton = true;


    /**
     * @var bool
     */
    public $hideIfNoItems = true;

    public function getContent()
    {

        if ($this->showSearchForm) {
            new TaskSearchForm($this);
        }

        $taskFilter = new TaskFilter();

        $taskReader = new TaskIndexReader();
        $taskReader->model->loadContent();
        $taskReader->model->content->loadContentType();
        $taskReader->model->loadAssignment();
        $taskReader->model->loadUser();
        $taskReader->model->loadTaskType();
        $taskReader->model->loadSource();
        $taskReader->model->source->loadContentType();
        $taskReader->filter = $taskFilter;
        $taskReader->filter->andEqual($taskReader->model->sourceId, $this->parentId);

        if ((new SortingParameter())->notExists()) {
            $taskReader->addOrder($taskReader->model->deadline);
            $taskReader->addOrder($taskReader->model->subject);
        }

        $count = new TaskIndexCount();
        $count->filter = $taskFilter;

        $p = new Paragraph($this);
        $p->content = $count->getFormatCount() . ' Aufgaben gefunden';

        $table = new AdminClickableTable($this);

        $header = new AdminTableHeader($table);
        $header->addEmpty();

        $sorting = new UpDownSortingHyperlink($header);
        $sorting->label = $taskReader->model->subject->label;
        $sorting->fieldType = $taskReader->model->subject;
        $sorting->checkSorting($taskReader);

        $sorting = new UpDownSortingHyperlink($header);
        $sorting->label = $taskReader->model->assignment->label;
        $sorting->fieldType = $taskReader->model->assignment->group;
        $sorting->checkSorting($taskReader);

        $header->addText($taskReader->model->deadline->label);
        $header->addText('Ersteller');

        if ($this->showAddButton) {
            $header->addEmpty();
        }

        foreach ($taskReader->getData() as $taskRow) {

            $row = new BootstrapClickableTableRow($table);

            if ($taskRow->closed) {
                new CheckIcon($row);
            } else {
                $trafficLight = new DateTrafficLight($row);
                $trafficLight->date = $taskRow->deadline;
            }

            $row->addText($taskRow->subject);
            $row->addText($taskRow->assignment->group);
            if ($taskRow->deadline !== null) {
                $row->addText($taskRow->deadline->getShortDateLeadingZeroFormat());
            } else {
                $row->addEmpty();
            }

            $ersteller = $taskRow->user->login . ' ' . $taskRow->dateTime->getShortDateLeadingZeroFormat();
            $row->addText($ersteller);

            if ($this->showAddButton) {
                $site = clone(ChildRemoveSite::$site);
                $site->addParameter(new ParentParameter($this->parentId));
                $site->addParameter(new ChildParameter($taskRow->contentId));
                $row->addIconSite($site);
            }

            $row->addClickableSite($taskRow->content->getContentType()->getViewSite());

        }

        if ($this->showAddButton) {
            $add = new SiteHyperlink($this);
            $add->showSiteTitle = false;
            $add->site = new Site();
            $add->site->addParameter(new StatusParameter((new ChildAddContentType())->typeId));
            new PlusIcon($add);
        }

        if ($this->hideIfNoItems) {
            if ($taskReader->getCount() == 0) {
                $this->visible = false;
            }
        }

        return parent::getContent();

    }

}