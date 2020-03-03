<?php


namespace Nemundo\Process\App\Task\Widget;


use Nemundo\Admin\Com\Table\AdminClickableTable;
use Nemundo\Admin\Com\Widget\AdminWidget;
use Nemundo\Com\Html\Listing\UnorderedList;
use Nemundo\Com\TableBuilder\TableHeader;
use Nemundo\Db\Filter\Filter;
use Nemundo\Db\Sql\Field\CountField;
use Nemundo\Package\Bootstrap\Table\BootstrapClickableTableRow;
use Nemundo\Process\App\Task\Data\TaskIndex\TaskIndexPaginationReader;
use Nemundo\Process\App\Task\Data\TaskIndex\TaskIndexReader;
use Nemundo\Process\App\Task\Filter\TaskFilter;
use Nemundo\Process\Config\ProcessConfig;
use Nemundo\Process\Template\Content\User\UserContentType;
use Nemundo\User\Session\UserSession;
use Schleuniger\App\Aufgabe\Site\AufgabeSite;
use Schleuniger\App\Task\Com\Table\TaskTable;

class TaskWidget extends AdminWidget
{

    public function getContent()
    {

        $this->widgetTitle='Aufgaben';
        $this->widgetSite=AufgabeSite::$site;


        /*

        $taskReader = new TaskIndexReader();
        $taskReader->model->loadContent();
        $taskReader->model->content->loadContentType();
        $taskReader->model->loadAssignment();
        $taskReader->model->loadUser();
        $taskReader->model->loadTaskType();
        $taskReader->model->loadSource();
        $taskReader->model->source->loadContentType();

        $filter = new Filter();
        $userType = new UserContentType((new UserSession())->userId);
        foreach ($userType->getGroupIdList() as $groupId) {
            $filter->orEqual($taskReader->model->assignmentId, $groupId);
        }
        $taskReader->filter->andFilter($filter);

        $taskReader->filter->andEqual($taskReader->model->closed, false);

        $taskReader->addOrder($taskReader->model->deadline);
        $taskReader->addOrder($taskReader->model->subject);

        $taskReader->addGroup($taskReader->model->contentId);

        $count = new CountField($taskReader);

        $taskReader->limit= 20;

        $table = new AdminClickableTable($this);

        $header = new TableHeader($table);
        $header->addEmpty();
        $header->addText($taskReader->model->taskType->label);
        $header->addText($taskReader->model->subject->label);
        $header->addText($taskReader->model->assignment->label);
        $header->addText($taskReader->model->deadline->label);

        foreach ($taskReader->getData() as $taskRow) {

            $row = new BootstrapClickableTableRow($table);

            $taskRow->getTrafficLight($row);

            $row->addText($taskRow->taskType->contentType);
            $row->addText($taskRow->subject);

            //$row->addText($taskRow->source->subject);
            //$row->addText($taskRow->source->contentType->contentType);


            $taskRow->getAssignmentSpan($row);
            $row->addText($taskRow->getDeadline());
            //$row->addText($taskRow->getCreator());
            $row->addClickableSite($taskRow->content->getContentType()->getViewSite());


        }*/



        return parent::getContent();
    }

}