<?php


namespace Nemundo\Process\Site;


use Nemundo\Admin\Com\Button\AdminSiteButton;
use Nemundo\Admin\Com\Navigation\AdminNavigation;
use Nemundo\Admin\Com\Title\AdminTitle;
use Nemundo\Admin\Com\Widget\AdminWidget;
use Nemundo\Dev\App\Factory\DefaultTemplateFactory;
use Nemundo\Process\Com\Container\StatusFormContainer;
use Nemundo\Process\Com\Container\WorkflowStreamContainer;
use Nemundo\Process\Com\Layout\WorkflowLayout;
use Nemundo\Process\Com\Menu\ProcessMenu;
use Nemundo\Process\Com\Table\WorkflowLogTable;
use Nemundo\Process\Data\Process\ProcessReader;
use Nemundo\Process\Data\Workflow\WorkflowReader;
use Nemundo\Process\Parameter\ProcessParameter;
use Nemundo\Process\Parameter\StatusParameter;
use Nemundo\Process\Parameter\WorkflowParameter;
use Nemundo\Process\View\ProcessView;
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
        $this->menuActive=false;

        WorkflowItemSite::$site=$this;

    }


    public function loadContent()
    {

        $page = (new DefaultTemplateFactory())->getDefaultTemplate();

        $nav = new AdminNavigation($page);
        $nav->site = ProcessSite::$site;

        $view = new ProcessView($page);
        $view->workflowId = (new WorkflowParameter())->getValue();
        $view->redirectSite=WorkflowItemSite::$site;

        $page->render();

    }

}