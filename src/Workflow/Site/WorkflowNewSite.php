<?php


namespace Nemundo\Process\Workflow\Site;


use Nemundo\Admin\Com\Navigation\AdminNavigation;
use Nemundo\Admin\Com\Title\AdminTitle;
use Nemundo\Dev\App\Factory\DefaultTemplateFactory;
use Nemundo\Process\Workflow\Content\View\ProcessView;
use Nemundo\Process\Workflow\Parameter\ProcessParameter;
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

        $process = (new ProcessParameter())->getProcess();

        $title = new AdminTitle($page);
        $title->content = $process->typeLabel;

        $view = new ProcessView($page);
        $view->process = $process;
        $view->redirectSite = WorkflowItemSite::$site;
        $view->appendWorkflowParameter = true;

        $page->render();

    }

}