<?php


namespace Nemundo\Process\Workflow\Site;


use App\App\Group\Item\GroupItem;
use App\App\IssueTracker\Workflow\Process\IssueTrackerProcess;
use App\App\Journey\Content\Process\JourneyProcess;
use Nemundo\Admin\Com\Navigation\AdminNavigation;
use Nemundo\Admin\Com\Table\AdminClickableTable;
use Nemundo\Com\TableBuilder\TableHeader;
use Nemundo\Db\Sql\Order\SortOrder;
use Nemundo\Dev\App\Factory\DefaultTemplateFactory;
use Nemundo\Package\Bootstrap\Dropdown\BootstrapSiteDropdown;
use Nemundo\Package\Bootstrap\Pagination\BootstrapPagination;
use Nemundo\Package\Bootstrap\Table\BootstrapClickableTableRow;
use Nemundo\Process\Content\Com\Dropdown\ContentTypeDropdown;
use Nemundo\Process\Group\Content\Group\GroupContentType;
use Nemundo\Process\Group\Content\GroupContentItem;
use Nemundo\Process\Workflow\Com\Form\WorkflowSearchForm;
use Nemundo\Process\Workflow\Data\Process\ProcessReader;
use Nemundo\Process\Workflow\Data\Workflow\WorkflowPaginationReader;
use Nemundo\Process\Workflow\Parameter\ProcessParameter;
use Nemundo\Process\Workflow\Parameter\WorkflowParameter;

use Nemundo\Process\Template\Site\FileDeleteSite;
use Nemundo\ToDo\Workflow\Process\ToDoProcess;
use Nemundo\User\Parameter\UserParameter;
use Nemundo\User\Session\UserSession;
use Nemundo\Web\Site\AbstractSite;
use Nemundo\Workflow\App\Identification\Config\IdentificationConfig;
use Nemundo\Workflow\Com\TrafficLight\DateTrafficLight;
use Nemundo\Workflow\Com\TrafficLight\TrafficLight;


class WorkflowInboxSite extends AbstractSite
{



    protected function loadSite()
    {

        $this->title = 'Workflow Inbox';
        $this->url = 'workflow-inbox';

    }


    public function loadContent()
    {

        $page = (new DefaultTemplateFactory())->getDefaultTemplate();





        $table = new AdminClickableTable($page);

        $header = new TableHeader($table);
        $header->addEmpty();
        $header->addText('Closed');
        $header->addText('Process');
        $header->addText('Workflow');
        $header->addText('Deadline');
        $header->addText('Assign to');
        $header->addText('Group Assign to');

        $header->addText('Status');
        $header->addText('User');
        $header->addText('Date/Time');

        $workflowReader = new WorkflowPaginationReader();
        $workflowReader->model->loadContent();
        $workflowReader->model->content->loadUser();
        $workflowReader->model->loadStatus();
        $workflowReader->model->loadAssignment();


        /*
        $processParameter = new ProcessParameter();
        if ($processParameter->hasValue()) {
            $workflowReader->filter->andEqual($workflowReader->model->processId, $processParameter->getValue());
        }

        $userParameter=new UserParameter();
        if ($userParameter->hasValue()) {
            $workflowReader->filter->andEqual($workflowReader->model->assignment->identificationId,$userParameter->getValue());
        }*/


        /*$userId = (new UserSession())->userId;
        foreach ((new IdentificationConfig())->getIdentificationList() as $identification) {

            foreach ($identification->getIdentificationIdFromUserId($userId) as $value) {
                $workflowReader->filter->orEqual($workflowReader->model->assignment->identificationId, $value);
            }

        }*/



        $workflowReader->addOrder($workflowReader->model->content->dateTime, SortOrder::DESCENDING);
        $workflowReader->paginationLimit = 50;
        foreach ($workflowReader->getData() as $workflowRow) {

            $row = new BootstrapClickableTableRow($table);

            $trafficLight = new DateTrafficLight($row);
            $trafficLight->date = $workflowRow->deadline;

            $row->addYesNo($workflowRow->workflowClosed);
            $row->addText($workflowRow->content->contentType);
            $row->addText($workflowRow->getSubject());


            if ($workflowRow->deadline!==null) {
            $row->addText($workflowRow->deadline->getShortDateLeadingZeroFormat());
            } else {
                $row->addEmpty();
            }

            //$row->addText($workflowRow->assignment->getValue());

            $row->addText($workflowRow->assignment->group);

            if ($workflowRow->assignmentId!=='') {

//            $item=new GroupContentItem($workflowRow->groupAssignmentId);

                $type=new GroupContentType($workflowRow->assignmentId);
                $type->getView($row);

            }

            $row->addText($workflowRow->status->contentType);
            $row->addText($workflowRow->content->user->displayName);
            $row->addText($workflowRow->content->dateTime->getShortDateTimeWithSecondLeadingZeroFormat());

            $site = clone(WorkflowItemSite::$site);
            $site->addParameter(new WorkflowParameter($workflowRow->id));
            $row->addClickableSite($site);

        }

        $pagination = new BootstrapPagination($page);
        $pagination->paginationReader = $workflowReader;

        $page->render();

    }

}