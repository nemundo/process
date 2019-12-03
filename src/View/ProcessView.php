<?php


namespace Nemundo\Process\View;


use Nemundo\Admin\Com\Title\AdminTitle;
use Nemundo\Admin\Com\Widget\AdminWidget;
use Nemundo\Html\Container\AbstractHtmlContainer;
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
use Nemundo\Process\Process\AbstractProcess;
use Nemundo\Process\Site\WorkflowItemSite;

class ProcessView extends AbstractHtmlContainer
{

    public $workflowId;

    /**
     * @var AbstractProcess
     */
public $process;


    public function getContent()
    {


       // $workflowParameter = new WorkflowParameter();

        //$workflowId = null;
        //$process=null;
        $workflowStatus =null;
        $formStatus = null;
        $workflowTitle =  null;

        if ($this->workflowId !==null) {

            //$workflowId = (new WorkflowParameter())->getValue();

            $workflowReader = new WorkflowReader();
            $workflowReader->model->loadProcess();
            $workflowReader->model->loadStatus();
            $workflowRow =   $workflowReader->getRowById($this->workflowId);
            //$process=   $workflowRow->process->getProcess();

            $workflowStatus =$workflowRow->status->getStatus();
            $formStatus = (new StatusParameter())->getStatus();

            $workflowTitle =    $workflowRow->getSubject();
            

            
            

        } else {

            //$processParameter = new ProcessParameter();

            //$processRow = (new ProcessReader())->getRowById($processParameter->getValue());
            //$process = $processRow->getProcess();

            $formStatus = $this->process->startStatus;
            $workflowStatus = $formStatus;
            $workflowTitle =  'Neu';

        }

        if ($formStatus === null) {
            $formStatus = $workflowStatus->nextStatus;
        }


        $title = new AdminTitle($this);
        $title->content =$workflowTitle;  // $workflowRow->getSubject();  //workflowNumber;

        $layout =new WorkflowLayout($this);


        if ($this->workflowId !==null) {

            if ($this->process->baseViewClass !== null) {

                /** @var AbstractStatusView $view */
              $view=  new $this->process->baseViewClass($layout->col3);
$view->workflowId=$this->workflowId;

            }


        }



        $menu = new ProcessMenu($layout->col1);
        $menu->process =  $this->process;
        $menu->workflowId = $this->workflowId;
        $menu->formStatus = $formStatus;
        $menu->workflowStatus = $workflowStatus;
        $menu->site = WorkflowItemSite::$site;
        $menu->site->addParameter(new WorkflowParameter($this->workflowId));
        // $menu->site->addParameter($ecoParameter);


        if ($formStatus!==null) {
            $widget = new AdminWidget($layout->col2);
            $widget->widgetTitle =$formStatus->label;

            $form = new StatusFormContainer($widget);
            $form->formStatus = $formStatus;
            $form->workflowStatus = $workflowStatus;
            $form->site = WorkflowItemSite::$site;
            $form->workflowId = $this->workflowId;
        }

        $view = new WorkflowStreamContainer($layout->col2);
        $view->workflowId= $this->workflowId;


        $table = new WorkflowLogTable($layout->col3);
        $table->workflowId=$this->workflowId;

        return parent::getContent();

    }

}