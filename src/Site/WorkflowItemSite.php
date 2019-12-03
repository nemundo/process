<?php


namespace Nemundo\Process\Site;


use Nemundo\Admin\Com\Button\AdminSiteButton;
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


        $btn = new AdminSiteButton($page);
        $btn->site= WorkflowSite::$site;


        $workflowParameter = new WorkflowParameter();

        $workflowId = null;
        $process=null;
        $workflowStatus =null;
        $formStatus = null;
        $workflowTitle =  null;

        if ($workflowParameter->exists()) {

        $workflowId = (new WorkflowParameter())->getValue();

        $workflowReader = new WorkflowReader();
        $workflowReader->model->loadProcess();
        $workflowReader->model->loadStatus();
        $workflowRow =   $workflowReader->getRowById($workflowId);
     $process=   $workflowRow->process->getProcess();

            $workflowStatus =$workflowRow->status->getStatus();
            $formStatus = (new StatusParameter())->getStatus();

         $workflowTitle =    $workflowRow->getSubject();

        } else {

            $processParameter = new ProcessParameter();

            $processRow = (new ProcessReader())->getRowById($processParameter->getValue());
            $process = $processRow->getProcess();

            $formStatus = $process->startStatus;
            $workflowStatus = $formStatus;
            $workflowTitle =  'Neu';

        }




        if ($formStatus === null) {
            $formStatus = $workflowStatus->nextStatus;
        }


        $title = new AdminTitle($page);
        $title->content =$workflowTitle;  // $workflowRow->getSubject();  //workflowNumber;

        $layout =new WorkflowLayout($page);


        $menu = new ProcessMenu($layout->col1);
        $menu->process =  $process;
        $menu->workflowId = $workflowId;
        $menu->formStatus = $formStatus;
       $menu->workflowStatus = $workflowStatus;
        $menu->site = WorkflowItemSite::$site;
        $menu->site->addParameter(new WorkflowParameter($workflowId));
       // $menu->site->addParameter($ecoParameter);


        if ($formStatus!==null) {
        $widget = new AdminWidget($layout->col2);
        $widget->widgetTitle =$formStatus->label;

        $form = new StatusFormContainer($widget);
        $form->formStatus = $formStatus;
        $form->workflowStatus = $workflowStatus;
        $form->site = WorkflowItemSite::$site;
        $form->workflowId = $workflowId;
        }

        $view = new WorkflowStreamContainer($layout->col2);
        $view->workflowId= $workflowId;


        $table = new WorkflowLogTable($layout->col3);
        $table->workflowId=$workflowId;

        $page->render();

    }

}