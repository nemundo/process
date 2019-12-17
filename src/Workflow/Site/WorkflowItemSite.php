<?php


namespace Nemundo\Process\Workflow\Site;


use Nemundo\Admin\Com\Navigation\AdminNavigation;
use Nemundo\Dev\App\Factory\DefaultTemplateFactory;
use Nemundo\Process\Workflow\Parameter\WorkflowParameter;
use Nemundo\Process\Workflow\Content\View\ProcessView;
use Nemundo\Web\Site\AbstractSite;

class WorkflowItemSite extends AbstractSite
{

    /**
     * @var WorkflowItemSite
     */
    public static $site;

    public function loadSite()
    {

        $this->url = 'item';
        $this->menuActive = false;

        WorkflowItemSite::$site = $this;

    }


    public function loadContent()
    {

        $page = (new DefaultTemplateFactory())->getDefaultTemplate();

        $nav = new AdminNavigation($page);
        $nav->site =WorkflowSite::$site;

        $view = new ProcessView($page);
        $view->dataId = (new WorkflowParameter())->getValue();
        $view->redirectSite = WorkflowItemSite::$site;
        $view->redirectSite->addParameter(new WorkflowParameter());

        $page->render();

    }

}