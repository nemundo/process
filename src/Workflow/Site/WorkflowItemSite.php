<?php


namespace Nemundo\Process\Workflow\Site;


use Nemundo\Admin\Com\Navigation\AdminNavigation;
use Nemundo\Core\Debug\Debug;
use Nemundo\Dev\App\Factory\DefaultTemplateFactory;
use Nemundo\Process\Workflow\Content\Process\WorkflowProcess;
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

        $workflowId =  (new WorkflowParameter())->getValue();

        $workflowType = new WorkflowProcess($workflowId);
        $process= $workflowType->getProcess();


        //(new Debug())->write($process);

        $view = new ProcessView($page);
        $view->process=$process;
        $view->dataId = $workflowId;  // (new WorkflowParameter())->getValue();
        $view->redirectSite = WorkflowItemSite::$site;
        $view->redirectSite->addParameter(new WorkflowParameter());

        $page->render();

    }

}