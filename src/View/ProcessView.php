<?php


namespace Nemundo\Process\View;


use Nemundo\Admin\Com\Title\AdminSubtitle;
use Nemundo\Admin\Com\Title\AdminTitle;
use Nemundo\Admin\Com\Widget\AdminWidget;
use Nemundo\Com\FormBuilder\RedirectTrait;
use Nemundo\Html\Container\AbstractHtmlContainer;
use Nemundo\Process\Com\Button\NextStatusButton;
use Nemundo\Process\Com\Container\StatusFormContainer;
use Nemundo\Process\Com\Container\WorkflowStreamContainer;
use Nemundo\Process\Com\Dropdown\MenuStatusDropdown;
use Nemundo\Process\Com\Layout\WorkflowLayout;
use Nemundo\Process\Com\Menu\ProcessMenu;
use Nemundo\Process\Com\Table\WorkflowLogTable;
use Nemundo\Process\Data\Workflow\WorkflowReader;
use Nemundo\Process\Parameter\StatusParameter;
use Nemundo\Process\Parameter\WorkflowParameter;
use Nemundo\Process\Process\AbstractProcess;
use Nemundo\Process\Site\WorkflowItemSite;

class ProcessView extends AbstractHtmlContainer
{

    use RedirectTrait;

    public $workflowId;

    /**
     * @var AbstractProcess
     */
    public $process;


    public $showDocument = true;

    public function getContent()
    {

        $workflowStatus = null;
        $formStatus = null;
        $workflowTitle = null;

        if ($this->workflowId !== null) {

            $workflowReader = new WorkflowReader();
            $workflowReader->model->loadProcess();
            $workflowReader->model->loadStatus();
            $workflowRow = $workflowReader->getRowById($this->workflowId);
            $workflowStatus = $workflowRow->status->getStatus();
            $formStatus = (new StatusParameter())->getStatus();
            $workflowTitle = $workflowRow->getSubject();
            $this->process = $workflowRow->process->getProcess();

        } else {

            $formStatus = $this->process->startStatus;
            $workflowStatus = $formStatus;
            $workflowTitle = 'Neu';

        }

        if ($formStatus === null) {
            $formStatus = $workflowStatus->getNextStatus();
        }

        $title = new AdminTitle($this);
        $title->content = $workflowTitle;

        $layout = new WorkflowLayout($this);


        if ($this->workflowId !== null) {

            if ($this->process->baseViewClass !== null) {

                /** @var AbstractStatusView $view */
                $view = new $this->process->baseViewClass($layout->col3);
                $view->workflowId = $this->workflowId;

            }

        }


        $btn = new NextStatusButton($layout->col1);
        $btn->site = $this->redirectSite;
        $btn->status = $workflowStatus->getNextStatus();

$dropdown = new MenuStatusDropdown($layout->col1);
$dropdown->status = $workflowStatus;
$dropdown->redirectSite =  $this->redirectSite;


        $menu = new ProcessMenu($layout->col1);
        $menu->process = $this->process;
        $menu->workflowId = $this->workflowId;
        $menu->formStatus = $formStatus;
        $menu->workflowStatus = $workflowStatus;
        $menu->site =$this->redirectSite;
        $menu->site->addParameter(new WorkflowParameter($this->workflowId));

        if ($formStatus !== null) {
            $widget = new AdminWidget($layout->col2);
            $widget->widgetTitle = $formStatus->label;

            $form = new StatusFormContainer($widget);
            $form->formStatus = $formStatus;
            $form->workflowStatus = $workflowStatus;
            $form->site = $this->redirectSite;
            $form->workflowId = $this->workflowId;
        }

        $view = new WorkflowStreamContainer($layout->col2);
        $view->workflowId = $this->workflowId;


        /*
        $subtitle = new AdminSubtitle($layout->col3);
        $subtitle->content = 'Document';

        $view = new WorkflowDocumentView($layout->col3);
        $view->workflowId=$this->workflowId;*/



        //$subtitle = new AdminSubtitle($layout->col3);
        //$subtitle->content = 'Log';

        $table = new WorkflowLogTable($layout->col3);
        $table->workflowId = $this->workflowId;

        return parent::getContent();

    }

}