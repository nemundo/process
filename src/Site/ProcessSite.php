<?php


namespace Nemundo\Process\Site;


use Nemundo\Admin\Com\Navigation\AdminNavigation;
use Nemundo\Admin\Com\Table\AdminClickableTable;
use Nemundo\Com\TableBuilder\TableHeader;
use Nemundo\Db\Sql\Order\SortOrder;
use Nemundo\Dev\App\Factory\DefaultTemplateFactory;
use Nemundo\Package\Bootstrap\Dropdown\BootstrapSiteDropdown;
use Nemundo\Package\Bootstrap\Pagination\BootstrapPagination;
use Nemundo\Package\Bootstrap\Table\BootstrapClickableTableRow;
use Nemundo\Process\Com\Form\WorkflowSearchForm;
use Nemundo\Process\Data\Process\ProcessReader;
use Nemundo\Process\Data\Workflow\WorkflowPaginationReader;
use Nemundo\Process\Parameter\ProcessParameter;
use Nemundo\Process\Parameter\WorkflowParameter;
use Nemundo\Process\Template\Data\Document\Redirect\DocumentDocumentRedirectSite;
use Nemundo\Process\Template\Site\DocumentDeleteSite;
use Nemundo\Web\Site\AbstractSite;


class ProcessSite extends AbstractSite
{

    /**
     * @var ProcessSite
     */
    public static $site;

    protected function loadSite()
    {

        $this->title = 'Process';
        $this->url = 'process';

        new WorkflowNewSite($this);
        new WorkflowItemSite($this);

        ProcessSite::$site = $this;

    }


    public function loadContent()
    {

        $page = (new DefaultTemplateFactory())->getDefaultTemplate();

        $nav = new AdminNavigation($page);
        $nav->site = ProcessSite::$site;


        $dropdown = new BootstrapSiteDropdown($page);

        new WorkflowSearchForm($page);

        $processReader = new ProcessReader();
        $processReader->addOrder($processReader->model->process);
        foreach ($processReader->getData() as $processRow) {
            $site = clone(WorkflowNewSite::$site);
            $site->title = $processRow->process;
            $site->addParameter(new ProcessParameter($processRow->id));
            $dropdown->addSite($site);
        }

        $table = new AdminClickableTable($page);

        $header = new TableHeader($table);
        $header->addText('Closed');
        $header->addText('Process');
        $header->addText('Workflow');
        $header->addText('Status');
        $header->addText('User');
        $header->addText('Date/Time');

        $workflowReader = new WorkflowPaginationReader();
        $workflowReader->model->loadProcess();
        $workflowReader->model->loadStatus();
        $workflowReader->model->loadUser();
        $processParameter = new ProcessParameter();
        if ($processParameter->hasValue()) {
            $workflowReader->filter->andEqual($workflowReader->model->processId, $processParameter->getValue());
        }
        $workflowReader->addOrder($workflowReader->model->dateTime, SortOrder::DESCENDING);
        $workflowReader->paginationLimit = 50;
        foreach ($workflowReader->getData() as $workflowRow) {

            $row = new BootstrapClickableTableRow($table);
            $row->addYesNo($workflowRow->workflowClosed);
            $row->addText($workflowRow->process->process);
            $row->addText($workflowRow->getSubject());
            $row->addText($workflowRow->status->statusLabel);
            $row->addText($workflowRow->user->displayName);
            $row->addText($workflowRow->dateTime->getShortDateTimeWithSecondLeadingZeroFormat());

            $site = clone(WorkflowItemSite::$site);
            $site->addParameter(new WorkflowParameter($workflowRow->id));
            $row->addClickableSite($site);

        }

        $pagination = new BootstrapPagination($page);
        $pagination->paginationReader = $workflowReader;

        $page->render();

    }

}