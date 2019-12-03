<?php


namespace Nemundo\Process\Site;


use Nemundo\Admin\Com\Table\AdminClickableTable;
use Nemundo\Admin\Com\Table\AdminTable;
use Nemundo\Com\TableBuilder\TableHeader;
use Nemundo\Db\Sql\Order\SortOrder;
use Nemundo\Dev\App\Factory\DefaultTemplateFactory;
use Nemundo\Package\Bootstrap\Dropdown\BootstrapSiteDropdown;
use Nemundo\Package\Bootstrap\Table\BootstrapClickableTableRow;
use Nemundo\Process\Com\ListBox\ProcessListBox;
use Nemundo\Process\Data\Process\ProcessReader;
use Nemundo\Process\Data\Workflow\WorkflowReader;
use Nemundo\Process\Parameter\ProcessParameter;
use Nemundo\Process\Parameter\WorkflowParameter;
use Nemundo\Web\Site\AbstractSite;

class WorkflowSite extends AbstractSite
{

    /**
     * @var WorkflowSite
     */
    public static $site;

    protected function loadSite()
    {
        // TODO: Implement loadSite() method.
        $this->title = 'Process';
        $this->url = 'process';

        new WorkflowNewSite($this);
        new WorkflowItemSite($this);

        WorkflowSite::$site=$this;

    }

    public function loadContent()
    {


        $page = (new DefaultTemplateFactory())->getDefaultTemplate();


        $dropdown = new BootstrapSiteDropdown($page);

        $workflowReader = new ProcessReader();
        foreach ($workflowReader->getData() as $processRow) {
            //$site = clone(WorkflowNewSite::$site);
            $site=clone(WorkflowItemSite::$site);
            $site->title = $processRow->process;
            $site->addParameter(new ProcessParameter($processRow->id));
            $dropdown->addSite($site);
        }

      //  new ProcessListBox($page);



        $table = new AdminClickableTable($page);

        $header = new TableHeader($table);
        $header->addText('Closed');
        $header->addText('Process');
        $header->addText('Workflow');

        $header->addText('Status');



        $workflowReader = new WorkflowReader();
        $workflowReader->model->loadProcess();
        $workflowReader->model->loadStatus();
        $workflowReader->addOrder($workflowReader->model->id, SortOrder::DESCENDING);
        foreach ($workflowReader->getData() as $workflowRow) {


            $row = new BootstrapClickableTableRow($table);

            $row->addYesNo($workflowRow->workflowClosed);
            $row->addText($workflowRow->process->process);

            //$row->addText($workflowRow->workflowNumber);
            $row->addText($workflowRow->getSubject());
            $row->addText($workflowRow->status->statusLabel);

            $site = clone(WorkflowItemSite::$site);
            $site->addParameter(new WorkflowParameter($workflowRow->id));
            $row->addClickableSite($site);

        }


        $page->render();


    }

}