<?php


namespace Nemundo\Process\Site;


use Nemundo\Process\App\Favorite\Site\FavoriteSaveSite;
use Nemundo\Process\App\Favorite\Site\FavoriteSite;
use Nemundo\Process\App\Inbox\Site\InboxSite;
use Nemundo\Process\App\Wiki\Site\WikiSite;
use Nemundo\Process\Content\Site\ContentSite;
use Nemundo\Process\Content\Site\ContentTypeSite;
use Nemundo\Process\Content\Site\DocumentSite;
use Nemundo\Process\Search\Site\SearchSite;
use Nemundo\Process\Template\Site\ProcessTemplateSite;
use Nemundo\Process\Workflow\Site\WorkflowSite;
use Nemundo\ToDo\Site\ToDoSite;
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

        ProcessSite::$site = $this;

        //new DocumentSite($this);
        new ContentTypeSite($this);
        new ContentSite($this);
        new WorkflowSite($this);
        new InboxSite($this);
        new WikiSite($this);
        new ProcessTemplateSite($this);

        new ToDoSite($this);
        new SearchSite($this);
        new FavoriteSite($this);

        new StartSite($this);


    }


    public function loadContent()
    {


        /*
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

         $page->render();*/

    }

}