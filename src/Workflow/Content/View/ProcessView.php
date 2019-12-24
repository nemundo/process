<?php


namespace Nemundo\Process\Workflow\Content\View;


use Nemundo\Admin\Com\Title\AdminTitle;
use Nemundo\Admin\Com\Widget\AdminWidget;
use Nemundo\Com\FormBuilder\RedirectTrait;
use Nemundo\Html\Block\Hr;
use Nemundo\Process\App\Favorite\Com\FavoriteButton;
use Nemundo\Process\Group\Com\GroupParentContainer;
use Nemundo\Process\Workflow\Com\Container\AbstractWorkflowContainer;
use Nemundo\Process\Workflow\Com\Container\StatusFormContainer;
use Nemundo\Process\Workflow\Com\Container\WorkflowStreamContainer;
use Nemundo\Process\Workflow\Com\Layout\WorkflowLayout;
use Nemundo\Process\Workflow\Com\Menu\HistoryProcessMenu;
use Nemundo\Process\Workflow\Com\Menu\ProcessMenu;

use Nemundo\Process\Workflow\Com\Table\SourceTable;
use Nemundo\Process\Workflow\Com\Table\WorkflowLogTable;
use Nemundo\Process\Content\View\AbstractContentView;
use Nemundo\Process\Workflow\Data\Workflow\WorkflowReader;
use Nemundo\Process\Workflow\Parameter\StatusParameter;
use Nemundo\Process\Workflow\Parameter\WorkflowParameter;

use Nemundo\Process\Workflow\Content\Process\AbstractProcess;
use Nemundo\ToDo\Com\ToDoParentContainer;
use Nemundo\Web\Site\Site;

class ProcessView extends AbstractContentView
{

    use RedirectTrait;

    /**
     * @var AbstractProcess
     */
    public $contentType;


    public $appendWorkflowParameter = false;

    public $showDocument = true;

    public function getContent()
    {

        $workflowStatus = null;
        $formStatus = null;
        $workflowTitle = null;

        if ($this->redirectSite == null) {
            $this->redirectSite = new Site();
        }
        $this->redirectSite->addParameter(new WorkflowParameter());

        if ($this->dataId !== null) {

            $workflowReader = new WorkflowReader();
            $workflowReader->model->loadProcess();
            $workflowReader->model->loadStatus();
            $workflowReader->model->status->loadContentType();
            $workflowReader->model->process->loadContentType();
            $workflowRow = $workflowReader->getRowById($this->dataId);

            $workflowStatus = $workflowRow->status->getStatus();
            $formStatus = (new StatusParameter())->getStatus();
            $workflowTitle = $workflowRow->getSubject();
            $this->contentType = $workflowRow->process->getProcess();

        } else {

            $formStatus = $this->contentType->startStatus;
            $workflowStatus = $formStatus;
            $workflowTitle = 'Neu';

        }

        if ($formStatus === null) {
            $formStatus = $workflowStatus->getNextStatus();
        }

        $title = new AdminTitle($this);
        $title->content = $workflowTitle;

        $layout = new WorkflowLayout($this);


        if ($this->dataId !== null) {


            $btn=new FavoriteButton($layout->col3);
            //$btn->contentType = $this->contentType;
            $btn->dataId = $this->dataId;

            if ($this->contentType->baseViewClass !== null) {

                /** @var AbstractWorkflowContainer $view */
                $view = new $this->contentType->baseViewClass($layout->col3);
                $view->workflowId = $this->dataId;

            }

        }


        /*$btn = new NextStatusButton($layout->col1);
        $btn->site = clone($this->redirectSite);
        $btn->status = $workflowStatus->getNextStatus();

        $dropdown = new MenuStatusDropdown($layout->col1);
        $dropdown->status = $workflowStatus;
        $dropdown->redirectSite = clone($this->redirectSite);*/


        /*$menu =  new HistoryProcessMenu($layout->col1);
        $menu->process = $this->process;
        $menu->workflowId = $this->workflowId;
        $menu->formStatus = $formStatus;
        $menu->workflowStatus = $workflowStatus;
        $menu->site = clone($this->redirectSite);
        $menu->site->addParameter(new WorkflowParameter($this->workflowId));


        $menu = new ProcessMenu($layout->col1);  // new HistoryProcessMenu($layout->col1);
        $menu->process = $this->process;
        $menu->workflowId = $this->workflowId;
        $menu->formStatus = $formStatus;
        $menu->workflowStatus = $workflowStatus;
        $menu->site = clone($this->redirectSite);
        $menu->site->addParameter(new WorkflowParameter($this->workflowId));*/






        //(new Hr($layout->col1));

        $menu =new ProcessMenu($layout->col1);
        $menu->process = $this->contentType;
        $menu->workflowId = $this->dataId;
        $menu->formStatus = $formStatus;
        $menu->workflowStatus = $workflowStatus;
        $menu->site = clone($this->redirectSite);
        $menu->site->addParameter(new WorkflowParameter($this->dataId));


        /*
        (new Hr($layout->col1));

        $menu =new HistoryProcessMenu($layout->col1);
        $menu->process = $this->contentType;
        $menu->workflowId = $this->dataId;
        $menu->formStatus = $formStatus;
        $menu->workflowStatus = $workflowStatus;
        $menu->site = clone($this->redirectSite);
        $menu->site->addParameter(new WorkflowParameter($this->dataId));
*/

        if ($formStatus !== null) {
            $widget = new AdminWidget($layout->col2);
            $widget->widgetTitle = $formStatus->type;

            $form = new StatusFormContainer($widget);
            $form->formStatus = $formStatus;
            $form->workflowStatus = $workflowStatus;
            $form->site = clone($this->redirectSite);
            $form->workflowId = $this->dataId;
            $form->appendWorkflowParameter=$this->appendWorkflowParameter;
        }



        $view = new WorkflowStreamContainer($layout->col2);
        $view->workflowId = $this->dataId;

        $table = new SourceTable($layout->col3);
        $table->workflowId =  $this->dataId;

        //$table = new ToDoParentContainer($layout->col3);
        //$table->parentId = $this->dataId;


        $table = new WorkflowLogTable($layout->col3);
        $table->workflowId = $this->dataId;

        $container=new GroupParentContainer($layout->col3);
        $container->parentId=$this->dataId;

        return parent::getContent();

    }

}