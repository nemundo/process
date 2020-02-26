<?php


namespace Nemundo\Process\App\Assignment\Com\Container;


use Nemundo\Admin\Com\Table\AdminClickableTable;
use Nemundo\Admin\Com\Table\Header\UpDownSortingHyperlink;
use Nemundo\Com\TableBuilder\TableHeader;
use Nemundo\Package\Bootstrap\Table\BootstrapClickableTableRow;
use Nemundo\Package\FontAwesome\Icon\CheckIcon;
use Nemundo\Process\App\Assignment\Data\AssignmentIndex\AssignmentIndexReader;
use Nemundo\Process\Content\Com\Container\AbstractParentContainer;
use Nemundo\Process\Group\Com\Span\GroupSpan;
use Nemundo\Workflow\Com\TrafficLight\DateTrafficLight;
use Schleuniger\App\Aufgabe\Com\Form\AufgabeParentContainerSearchForm;
use Schleuniger\App\Aufgabe\Data\AufgabeIndex\AufgabeIndexReader;

class AssignmentParentContainer extends AbstractParentContainer
{

    public $showSearchForm = false;

    /**
     * @var bool
     */
    public $hideIfNoItems = true;

    public function getContent()
    {

        $indexReader = new AssignmentIndexReader();
        $indexReader->model->loadContent();
        $indexReader->model->content->loadContentType();
        $indexReader->model->content->loadUser();
        $indexReader->model->loadAssignment();

        /*if ($this->showSearchForm) {
            $form = new AufgabeParentContainerSearchForm($this);
            $aufgabeReader->filter = $form->getFilter();
        }*/

        $indexReader->filter->andEqual($indexReader->model->sourceId, $this->parentId);
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

            //$process = new AufgabeProcess($aufgabeRow->aufgabeId);
            $row->addClickableSite($content->getViewSite());

        }



        if ($this->hideIfNoItems) {
            if ($indexReader->getCount() == 0) {
                $this->visible = false;
            }
        }

        return parent::getContent();
    }

}