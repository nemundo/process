<?php


namespace Nemundo\Process\Workflow\Site;


use Nemundo\Admin\Com\Navigation\AdminNavigation;
use Nemundo\Admin\Com\Title\AdminTitle;
use Nemundo\Dev\App\Factory\DefaultTemplateFactory;
use Nemundo\Process\Workflow\Data\Process\ProcessReader;
use Nemundo\Process\Workflow\Parameter\ProcessParameter;
use Nemundo\Process\Workflow\Content\View\ProcessView;
use Nemundo\Web\Site\AbstractSite;

class WorkflowNewSite extends AbstractSite
{

    /**
     * @var WorkflowNewSite
     */
    public static $site;

    public function loadSite()
    {

        $this->title = 'New';
        $this->url = 'new';
        $this->menuActive = false;

        WorkflowNewSite::$site = $this;

    }


    public function loadContent()
    {

        $page = (new DefaultTemplateFactory())->getDefaultTemplate();

        $nav = new AdminNavigation($page);
        $nav->site = WorkflowSite::$site;


        $processParameter = new ProcessParameter();

        $processId = $processParameter->getValue();

        $processReader = new ProcessReader();
        $processReader->model->loadContentType();
        $processRow = $processReader->getRowById($processId);
        $process = $processRow->getProcess();

        $title = new AdminTitle($page);
        $title->content = $process->process;

        $view = new ProcessView($page);
        $view->contentType = $process;
        $view->redirectSite = WorkflowItemSite::$site;
        $view->appendWorkflowParameter=true;

        $page->render();

    }

}