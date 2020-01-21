<?php


namespace Nemundo\Process\Workflow\Site;


use Nemundo\Admin\Com\Navigation\AdminNavigation;
use Nemundo\Admin\Com\Table\AdminClickableTable;
use Nemundo\Com\TableBuilder\TableHeader;
use Nemundo\Db\Sql\Order\SortOrder;
use Nemundo\Dev\App\Factory\DefaultTemplateFactory;
use Nemundo\Package\Bootstrap\Pagination\BootstrapPagination;
use Nemundo\Package\Bootstrap\Table\BootstrapClickableTableRow;
use Nemundo\Process\Content\Com\Dropdown\ContentTypeDropdown;
use Nemundo\Process\Workflow\Com\Form\WorkflowSearchForm;
use Nemundo\Process\Workflow\Data\Process\ProcessReader;
use Nemundo\Process\Workflow\Data\Workflow\WorkflowPaginationReader;
use Nemundo\Process\Workflow\Parameter\ActiveParameter;
use Nemundo\Process\Workflow\Parameter\ProcessParameter;
use Nemundo\Process\Workflow\Parameter\WorkflowParameter;
use Nemundo\User\Parameter\UserParameter;
use Nemundo\Web\Site\AbstractSite;
use Nemundo\Workflow\Com\TrafficLight\DateTrafficLight;


class WorkflowSite extends AbstractSite
{

    /**
     * @var WorkflowSite
     */
    public static $site;

    protected function loadSite()
    {

        $this->title = 'Workflow';
        $this->url = 'workflow';

        new WorkflowNewSite($this);
        new WorkflowItemSite($this);

        WorkflowSite::$site = $this;

    }


    public function loadContent()
    {

        $page = (new DefaultTemplateFactory())->getDefaultTemplate();

        $nav = new AdminNavigation($page);
        $nav->site = WorkflowSite::$site;


        $dropdown = new ContentTypeDropdown($page);  // new BootstrapSiteDropdown($page);
        $dropdown->redirectSite = WorkflowNewSite::$site;

        $processReader = new ProcessReader();
        $processReader->model->loadContentType();
        $processReader->addOrder($processReader->model->contentType->contentType);
        foreach ($processReader->getData() as $processRow) {
            $site = clone(WorkflowNewSite::$site);
            $site->title = $processRow->getProcess()->typeLabel;
            $site->addParameter(new ProcessParameter($processRow->contentTypeId));

            $dropdown->addSite($site);
        }

        new WorkflowSearchForm($page);


        $table = new AdminClickableTable($page);

        $header = new TableHeader($table);
        $header->addText('Workflow Id');
        $header->addText('Content Id');
        $header->addText('Data Id');
        $header->addEmpty();
        $header->addText('Active');
        $header->addText('Closed');
        $header->addText('Process');
        $header->addText('Workflow');
        $header->addText('Deadline');
        $header->addText('Assignment');
        $header->addText('Status');
        $header->addText('User');
        $header->addText('Date/Time');

        $workflowReader = new WorkflowPaginationReader();
        $workflowReader->model->loadContent();
        $workflowReader->model->content->loadContentType();
        $workflowReader->model->content->loadUser();
        $workflowReader->model->loadStatus();
        $workflowReader->model->loadAssignment();


        $activeParameter = new ActiveParameter();
        if ($activeParameter->hasValue()) {

            if ($activeParameter->getValue() == 1) {
                $workflowReader->filter->andEqual($workflowReader->model->active, true);
            }

            if ($activeParameter->getValue() == 2) {
                $workflowReader->filter->andEqual($workflowReader->model->active, false);
            }

        } else {
            //$workflowReader->filter->andEqual($workflowReader->model->active, true);
        }


        $processParameter = new ProcessParameter();
        if ($processParameter->hasValue()) {
            $workflowReader->filter->andEqual($workflowReader->model->content->contentTypeId, $processParameter->getValue());
        }

        $userParameter = new UserParameter();
        if ($userParameter->hasValue()) {
            //$workflowReader->filter->andEqual($workflowReader->model->assignment->identificationId,$userParameter->getValue());
        }

        $workflowReader->addOrder($workflowReader->model->contentId, SortOrder::DESCENDING);
        $workflowReader->paginationLimit = 50;
        foreach ($workflowReader->getData() as $workflowRow) {


            $contentType = $workflowRow->content->getContentType();


            $row = new BootstrapClickableTableRow($table);

            $row->addText($workflowRow->id);
            $row->addText($workflowRow->contentId);
            $row->addText($workflowRow->content->dataId);

            $trafficLight = new DateTrafficLight($row);
            $trafficLight->date = $workflowRow->deadline;
            $row->addYesNo($workflowRow->active);
            $row->addYesNo($workflowRow->workflowClosed);
            $row->addText($workflowRow->content->contentType->contentType);


            $row->addText($workflowRow->getSubject());
            $row->addText($contentType->getSubject());


            if ($workflowRow->deadline !== null) {
                $row->addText($workflowRow->deadline->getShortDateLeadingZeroFormat());
            } else {
                $row->addEmpty();
            }

            $row->addText($workflowRow->assignment->group);
            $row->addText($workflowRow->status->contentType);
            $row->addText($workflowRow->content->user->displayName);
            $row->addText($workflowRow->content->dateTime->getShortDateTimeWithSecondLeadingZeroFormat());

            if ($contentType->hasViewSite()) {
                $row->addSite($contentType->getViewSite());
            } else {
                $row->addEmpty();
            }

            $site = clone(WorkflowItemSite::$site);
            $site->addParameter(new WorkflowParameter($workflowRow->id));
            $row->addClickableSite($site);


            // löschen

            // Active (Restore)


        }

        $pagination = new BootstrapPagination($page);
        $pagination->paginationReader = $workflowReader;

        $page->render();

    }

}