<?php


namespace Nemundo\Process\App\Task\Site;


use Nemundo\Admin\Com\Table\AdminClickableTable;
use Nemundo\Admin\Com\Table\AdminTable;
use Nemundo\Com\Html\Listing\UnorderedList;
use Nemundo\Com\TableBuilder\TableHeader;
use Nemundo\Com\TableBuilder\TableRow;
use Nemundo\Db\Sql\Field\CountField;
use Nemundo\Db\Sql\Order\SortOrder;
use Nemundo\Dev\App\Factory\DefaultTemplateFactory;
use Nemundo\Package\Bootstrap\Table\BootstrapClickableTableRow;
use Nemundo\Process\App\Task\Com\Form\TaskSearchForm;
use Nemundo\Process\App\Task\Data\Task\TaskReader;
use Nemundo\Process\App\Task\Data\TaskIndex\TaskIndexPaginationReader;
use Nemundo\Process\App\Task\Data\TaskIndex\TaskIndexReader;
use Nemundo\Process\App\Task\Filter\TaskFilter;
use Nemundo\Process\Config\ProcessConfig;
use Nemundo\Web\Site\AbstractSite;


class TaskSite extends AbstractSite
{

    protected function loadSite()
    {
        $this->title = 'Task';
        $this->url = 'task';
        // TODO: Implement loadSite() method.
    }


    public function loadContent()
    {

        $page = (new DefaultTemplateFactory())->getDefaultTemplate();


/*
        $reader = new TaskReader();
        $reader->model->loadSource();
        $reader->model->source->loadContentType();
        //$reader->model->loadTask();
        $reader->model->loadAssignment();


        $table=new AdminClickableTable($page);

        $row=new TableHeader($table);
        $row->addText('Source/Quelle');
        $row->addText('Task/Aufgabe');
        $row->addText('Assignment');
        $row->addText('Deadline');

        foreach ($reader->getData() as $taskRow) {

            $row=new BootstrapClickableTableRow($table);
            $row->addText($taskRow->source->subject);
            $row->addText($taskRow->task);
$row->addText($taskRow->assignment->group);
$row->addText($taskRow->deadline->getShortDateLeadingZeroFormat());

$row->addClickableSite($taskRow->source->getContentType()->getViewSite());


        }*/











        new TaskSearchForm($page);


        $taskReader = new TaskIndexPaginationReader();
        $taskReader->model->loadContent();
        $taskReader->model->content->loadContentType();
        $taskReader->model->loadAssignment();
        $taskReader->model->loadUser();
        $taskReader->model->loadTaskType();
        $taskReader->model->loadSource();
        $taskReader->model->source->loadContentType();

        $taskReader->filter = new TaskFilter();
//        $taskReader->addOrder($taskReader->model->deadline);
        $taskReader->addOrder($taskReader->model->dateTime,SortOrder::DESCENDING);


        $taskReader->addGroup($taskReader->model->contentId);

        $count = new CountField($taskReader);

        $taskReader->paginationLimit = ProcessConfig::PAGINATION_LIMIT;

        $table = new AdminClickableTable($page);

        $header = new TableHeader($table);
        $header->addText($taskReader->model->subject->label);
        $header->addText($taskReader->model->taskType->label);

        $header->addText('count');

        $header->addText($taskReader->model->source->label);
        $header->addText('Source Type');

        $header->addText($taskReader->model->message->label);
        $header->addText($taskReader->model->assignment->label);
        $header->addText($taskReader->model->deadline->label);
        $header->addText($taskReader->model->user->label);
        $header->addText($taskReader->model->dateTime->label);
        $header->addText($taskReader->model->closed->label);

        foreach ($taskReader->getData() as $taskRow) {

            $row = new BootstrapClickableTableRow($table);

            $taskRow->getTrafficLight($row);
            $row->addText($taskRow->subject);
            $row->addText($taskRow->taskType->contentType);

            $taskCount = $taskRow->getModelValue($count);

            $row->addText($taskCount);

            if ($taskCount > 0) {


                $ul = new UnorderedList($row);

                $sourceReader = new TaskIndexReader();
                $sourceReader->model->loadSource();
                $sourceReader->filter->andEqual($sourceReader->model->contentId, $taskRow->contentId);
                foreach ($sourceReader->getData() as $sourceRow) {
                    $ul->addText($sourceRow->source->subject);
                }

            } else {
                $row->addEmpty();
            }


            $row->addText($taskRow->source->subject);
            $row->addText($taskRow->source->contentType->contentType);


            $taskRow->getAssignmentSpan($row);

            /*
            $span=new GroupSpan($row);
            $span->groupId= $taskRow->assignmentId;
            $span->content = $taskRow->assignment->group;*/

            //$row->addText($taskRow->assignment->group);

            /* if ($taskRow->deadline !==null) {
             $row->addText($taskRow->deadline->getShortDateLeadingZeroFormat());
             } else {
                 $row->addEmpty();
             }*/

            $row->addText($taskRow->message);
            $row->addText($taskRow->getDeadline());

            //$row->addText($taskRow->user->login);
            $row->addText($taskRow->getCreator());  // $taskRow->dateTime->getShortDateTimeWithSecondLeadingZeroFormat());


            $row->addText( $taskRow->dateTime->getShortDateTimeWithSecondLeadingZeroFormat());



            //$row->addYesNo($taskRow->closed);

            $row->addClickableSite($taskRow->content->getContentType()->getViewSite());


        }


        $page->render();

        // TODO: Implement loadContent() method.
    }

}