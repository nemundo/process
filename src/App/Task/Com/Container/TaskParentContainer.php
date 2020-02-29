<?php

namespace Nemundo\Process\App\Task\Com\Container;


use Nemundo\Admin\Com\Table\AdminClickableTable;
use Nemundo\Admin\Com\Table\Header\UpDownSortingHyperlink;
use Nemundo\Admin\Com\Title\AdminSubtitle;
use Nemundo\Admin\Parameter\SortingParameter;
use Nemundo\Com\Html\Hyperlink\SiteHyperlink;
use Nemundo\Com\TableBuilder\TableHeader;
use Nemundo\Package\Bootstrap\Table\BootstrapClickableTableRow;
use Nemundo\Package\FontAwesome\Icon\CheckIcon;
use Nemundo\Package\FontAwesome\Icon\PlusIcon;
use Nemundo\Process\App\Task\Com\Form\TaskSearchForm;
use Nemundo\Process\App\Task\Data\TaskIndex\TaskIndexPaginationReader;
use Nemundo\Process\App\Task\Filter\TaskFilter;
use Nemundo\Process\Config\ProcessConfig;
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

    /**
     * @var bool
     */
    public $hideIfNoItems = true;

    public function getContent()
    {

        $subtitle = new AdminSubtitle($this);
        $subtitle->content = 'Aufgabenliste';


        if ($this->showSearchForm) {
            new TaskSearchForm($this);
        }


        $taskReader = new TaskIndexPaginationReader();
        $taskReader->model->loadContent();
        $taskReader->model->content->loadContentType();
        $taskReader->model->loadAssignment();
        $taskReader->model->loadUser();
        $taskReader->model->loadTaskType();
        $taskReader->model->loadSource();
        $taskReader->model->source->loadContentType();
        $taskReader->filter = new TaskFilter();
        $taskReader->filter->andEqual($taskReader->model->sourceId, $this->parentId);

//        $reader->filter = new TaskFilter();
        if ((new SortingParameter())->notExists()) {
        $taskReader->addOrder($taskReader->model->deadline);
            $taskReader->addOrder($taskReader->model->subject);
        }

        $taskReader->paginationLimit = ProcessConfig::PAGINATION_LIMIT;

        $table = new AdminClickableTable($this);

        $header = new TableHeader($table);
        $header->addEmpty();
        //$header->addText($taskReader->model->subject->label);
        //$header->addText($taskReader->model->taskType->label);

        //$header->addText($taskReader->model->source->label);
        //$header->addText('Source Type');


        //$header->addText($taskReader->model->assignment->label);


        $sorting = new UpDownSortingHyperlink($header);
        $sorting->label = $taskReader->model->subject->label;  //'Aufgabe';  // 'Betreff';
        $sorting->fieldType = $taskReader->model->subject;
        $sorting->checkSorting($taskReader);

        //$header->addText('Verantwortlicher');

        $sorting = new UpDownSortingHyperlink($header);
        $sorting->label = $taskReader->model->assignment->label;  // 'Verantwortlicher';
        $sorting->fieldType = $taskReader->model->assignment->group;
        $sorting->checkSorting($taskReader);


        $header->addText($taskReader->model->deadline->label);
        $header->addText($taskReader->model->user->label);
        //$header->addText($taskReader->model->dateTime->label);
        //$header->addText($taskReader->model->closed->label);

        foreach ($taskReader->getData() as $taskRow) {

            $row = new BootstrapClickableTableRow($table);

            if ($taskRow->closed) {
                new CheckIcon($row);
            } else {
                $trafficLight = new DateTrafficLight($row);
                $trafficLight->date = $taskRow->deadline;
            }

            $row->addText($taskRow->subject);
            //$row->addText($taskRow->taskType->contentType);

            //$row->addText($taskRow->source->subject);
            //$row->addText($taskRow->source->contentType->contentType);


            $row->addText($taskRow->assignment->group);
            $row->addText($taskRow->deadline->getShortDateLeadingZeroFormat());

            $ersteller = $taskRow->user->login . ' ' . $taskRow->dateTime->getShortDateLeadingZeroFormat();
            $row->addText($ersteller);

            //$row->addText($taskRow->dateTime->getShortDateTimeWithSecondLeadingZeroFormat());
            //$row->addYesNo($taskRow->closed);

            $site = clone(ChildRemoveSite::$site);
            $site->addParameter(new ParentParameter($this->parentId));
            $site->addParameter(new ChildParameter($taskRow->contentId));

            $row->addIconSite($site);


            $row->addClickableSite($taskRow->content->getContentType()->getViewSite());


        }


        /*

        $indexReader = new AssignmentIndexReader();
        $indexReader->model->loadContent();
        $indexReader->model->content->loadContentType();
        $indexReader->model->content->loadUser();
        $indexReader->model->loadAssignment();

        /*if ($this->showSearchForm) {
            $form = new AufgabeParentContainerSearchForm($this);
            $aufgabeReader->filter = $form->getFilter();
        }*/

        /*$indexReader->filter->andEqual($indexReader->model->sourceId, $this->parentId);
        $indexReader->addOrder($indexReader->model->deadline);

        $table = new AdminClickableTable($this);

        $header = new TableHeader($table);
        $header->addEmpty();
        //$header->addText('Aufgabe');


        $sorting = new UpDownSortingHyperlink($header);
        $sorting->label ='Aufgabe';  // 'Betreff';
        $sorting->fieldType = $indexReader->model->content->subject;
        $sorting->checkSorting($indexReader);

        //$header->addText('Verantwortlicher');

        $sorting = new UpDownSortingHyperlink($header);
        $sorting->label = 'Verantwortlicher';
        $sorting->fieldType = $indexReader->model->assignment->group;
        $sorting->checkSorting($indexReader);

        $header->addText('Erledigen bis');
        $header->addText('Ersteller');

        foreach ($indexReader->getData() as $indexRow) {

            $row = new BootstrapClickableTableRow($table);

            $content = $indexRow->content->getContentType();

            if ($indexRow->closed) {
                new CheckIcon($row);
            } else {
                $trafficLight = new DateTrafficLight($row);
                $trafficLight->date = $indexRow->deadline;
            }

            $row->addText($indexRow->content->subject); //aufgabe->getSubject());



            $span = new GroupSpan($row);
            $span->groupId = $indexRow->assignmentId;
$span->content = $indexRow->assignment->group;
            //$row->addText($indexRow->assignment->group);

            if ($indexRow->deadline !== null) {
                $row->addText($indexRow->deadline->getShortDateLeadingZeroFormat());
            } else {
                $row->addEmpty();
            }

            $row->addText($indexRow->content->user->login.' '.$indexRow->content->dateTime->getShortDateLeadingZeroFormat());



            $site = clone(ChildRemoveSite::$site);
            $site->addParameter(new ParentParameter($this->parentId));
            $site->addParameter(new ChildParameter($indexRow->contentId));

            $row->addIconSite($site);


            //$process = new AufgabeProcess($aufgabeRow->aufgabeId);
            $row->addClickableSite($content->getViewSite());

        }*/


        $add = new SiteHyperlink($this);
        $add->showSiteTitle = false;
        $add->site = new Site();
        $add->site->addParameter(new StatusParameter((new ChildAddContentType())->typeId));

        $icon = new PlusIcon($add);


        /*
        if ($this->hideIfNoItems) {
            if ($indexReader->getCount() == 0) {
                $this->visible = false;
            }
        }*/

        return parent::getContent();
    }

}