<?php


namespace Nemundo\Process\Workflow\Content\View;


use Nemundo\Admin\Com\Title\AdminTitle;
use Nemundo\Admin\Com\Widget\AdminWidget;
use Nemundo\Com\FormBuilder\RedirectTrait;
use Nemundo\Html\Formatting\Strike;
use Nemundo\Process\Content\Com\Table\SourceTable;
use Nemundo\Process\Content\View\AbstractContentView;
use Nemundo\Process\Template\Content\File\FileParentContainer;
use Nemundo\Process\Workflow\Com\Container\StatusFormContainer;
use Nemundo\Process\Workflow\Com\Container\WorkflowStreamContainer;
use Nemundo\Process\Workflow\Com\Layout\WorkflowLayout;
use Nemundo\Process\Workflow\Com\Menu\ProcessMenu;
use Nemundo\Process\Workflow\Com\Table\WorkflowLogTable;
use Nemundo\Process\Workflow\Parameter\StatusParameter;


class ProcessView extends AbstractProcessView
{

    public function getContent()
    {

        $workflowStatus = null;
        $formStatus = null;
        $workflowTitle = null;

        if ($this->dataId !== null) {

            $workflowRow = $this->contentType->getWorkflowRow();

            $workflowStatus = $workflowRow->status->getContentType();
            $workflowStatus->parentId = $this->dataId;

            $formStatus = (new StatusParameter())->getStatus();

            if ($formStatus !== null) {
                $formStatus->parentId = $this->contentType->getContentId();
            }

            if ($workflowRow->active) {
                $workflowTitle = $workflowRow->getSubject();
            } else {

                $strike = new Strike();
                $strike->content = $workflowRow->getSubject();
                $workflowTitle = $strike->getContent();

            }


        } else {

            $formStatus = $this->contentType;
            $workflowStatus = $formStatus;
            $workflowTitle = 'Neu';

        }

        if ($formStatus === null) {
            $formStatus = $workflowStatus->getNextMenu();

            if ($formStatus !== null) {
                $formStatus->parentId = $this->contentType->getContentId();
            }
        }

        $title = new AdminTitle($this);
        $title->content = $workflowTitle;

        $layout = new WorkflowLayout($this);

        if ($this->dataId !== null) {

            if ($this->contentType->hasView()) {
                $this->contentType->getView($layout->col3);
            }

        }

        $menu = new ProcessMenu($layout->col1);
        $menu->process = $this->contentType;
        $menu->workflowId = $this->dataId;
        $menu->formStatus = $formStatus;
        $menu->workflowStatus = $workflowStatus;
        $menu->site = clone($this->redirectSite);
        //$menu->site->addParameter(new EcrParameter($this->dataId));


        if ($formStatus !== null) {
            $widget = new AdminWidget($layout->col2);
            $widget->widgetTitle = $formStatus->typeLabel;

            $form = new StatusFormContainer($widget);
            $form->formStatus = $formStatus;
            $form->workflowStatus = $workflowStatus;
            $form->site = clone($this->redirectSite);
            if ($this->dataId !== null) {
                $form->parentId = $this->contentType->getContentId();
            }
            //$form->appendWorkflowParameter = $this->appendWorkflowParameter;
        }


        $container = new WorkflowStreamContainer($layout->col2);
        $container->contentType = $this->contentType;


        if ($this->dataId !== null) {


            //$btn = new FavoriteButton($layout->col3);
            //$btn->contentType = $this->contentType;


            $contentId = $this->contentType->getContentId();

            $view = new FileParentContainer($layout->col3);
            $view->parentId = $contentId;

            //$container = new AufgabeParentContainer($layout->col3);
            //$container->parentId = $contentId;

            $table = new SourceTable($layout->col3);
            $table->contentType = $this->contentType;

            //$btn = new AdminEventButton($layout->col3);
            //$btn->content = 'History anzeigen (Toggle)';

            $table = new WorkflowLogTable($layout->col3);
            $table->contentType = $this->contentType;


        }

        return parent::getContent();

    }

}