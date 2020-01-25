<?php


namespace Nemundo\Process\Workflow\Site;


use Nemundo\Admin\Com\Navigation\AdminNavigation;
use Nemundo\Dev\App\Factory\DefaultTemplateFactory;
use Nemundo\Process\Workflow\Parameter\WorkflowParameter;
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
        $nav->site = WorkflowSite::$site;

        //$workflowId =  (new WorkflowParameter())->getValue();

        //$workflowType = new WorkflowProcess($workflowId);
        //$process= $workflowType->getProcess();

        $process = (new WorkflowParameter())->getProcess();  //getContentType();
        $view = $process->getProcessView($page);
        $view->redirectSite = WorkflowItemSite::$site;
        $view->redirectSite->addParameter(new WorkflowParameter());


        //(new Debug())->write($process);

        /*        $view = new ProcessView($page);
                $view->process=$process;
                $view->dataId = $workflowId;  // (new WorkflowParameter())->getValue();
                $view->redirectSite = WorkflowItemSite::$site;
                $view->redirectSite->addParameter(new WorkflowParameter());*/

        $page->render();

    }

}