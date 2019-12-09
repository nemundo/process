<?php


namespace Nemundo\Process\Site;


use Nemundo\Admin\Com\Navigation\AdminNavigation;
use Nemundo\Admin\Com\Title\AdminTitle;
use Nemundo\Dev\App\Factory\DefaultTemplateFactory;
use Nemundo\Process\Data\Process\ProcessReader;
use Nemundo\Process\Parameter\ProcessParameter;
use Nemundo\Process\View\ProcessView;
use Nemundo\Web\Site\AbstractSite;

class WorkflowNewSite extends AbstractSite
{

    /**
     * @var WorkflowNewSite
     */
    public static $site;

    public function loadSite()
    {
        // TODO: Implement loadSite() method.
        $this->title='New';
        $this->url = 'new';
        $this->menuActive=false;

        WorkflowNewSite::$site=$this;

    }


    public function loadContent()
    {
        // TODO: Implement loadContent() method.

        $page = (new DefaultTemplateFactory())->getDefaultTemplate();

        $nav = new AdminNavigation($page);
        $nav->site = ProcessSite::$site;


        $processParameter = new ProcessParameter();

        $processId = $processParameter->getValue();

        $processRow = (new ProcessReader())->getRowById($processId);
        $process = $processRow->getProcess();

        $title = new AdminTitle($page);
        $title->content =$process->process;

        $view = new ProcessView($page);
        $view->process = $process;
        $view->redirectSite=WorkflowItemSite::$site;

        $page->render();

    }

}