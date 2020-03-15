<?php


namespace Nemundo\Process\Workflow\Content\View;


use Nemundo\Admin\Com\Title\AdminSubtitle;
use Nemundo\Admin\Com\Title\AdminTitle;
use Nemundo\Process\App\Favorite\Com\FavoriteButton;
use Nemundo\Process\Content\Com\Table\ContentLogTable;
use Nemundo\Process\Content\Com\Table\SourceTable;
use Nemundo\Process\Template\Content\File\FileParentContainer;
use Nemundo\Process\Workflow\Com\Container\StatusFormContainer;
use Nemundo\Process\Workflow\Com\Container\WorkflowStreamContainer;
use Nemundo\Process\Workflow\Com\Layout\WorkflowLayout;
use Nemundo\Process\Workflow\Com\Menu\WorkflowLogMenu;
use Nemundo\Process\Workflow\Content\Process\AbstractProcess;
use Nemundo\Process\Workflow\Content\Status\AbstractProcessStatus;
use Nemundo\Process\Workflow\Parameter\StatusParameter;
use Nemundo\ToDo\Data\ToDo\ToDoRow;


class ProcessView extends AbstractProcessView
{

    /**
     * @var AbstractProcess
     */
    public $contentType;

    public function getContent()
    {

        $workflowStatus = null;
        $formStatus = null;
        $workflowTitle = null;

        if ($this->contentType->getDataId() !== null) {

            /** @var ToDoRow $workflowRow */
            $workflowRow = $this->contentType->getDataRow();

            $workflowStatus = $workflowRow->status->getContentType();

            $workflowStatus->parentId = $this->contentType->getDataId();

            $statusParameter = new StatusParameter();
            if ($workflowStatus->hasNextMenu()) {
                $statusParameter->addAllowedContentType($workflowStatus->getNextMenu());
            }

            foreach ($workflowStatus->getMenuList() as $contentType) {
                $statusParameter->addAllowedContentType($contentType);
            }


            foreach ($this->contentType->getChild() as $contentRow) {

                /** @var AbstractProcessStatus $contentType */
                $contentType = $contentRow->getContentType();

                if ($contentType->isObjectOfClass(AbstractProcessStatus::class)) {

                    if ($contentType->editable) {
                        $statusParameter->addAllowedContentType($contentType);
                    }

                }

            }


            $formStatus = $statusParameter->getStatus();

            if ($formStatus !== null) {
                $formStatus->parentId = $this->contentType->getContentId();
            }


            /*
            if ($workflowRow->active) {
                $workflowTitle =  $workflowRow->getSubject();
            } else {

                $strike = new Strike();
                $strike->content = $workflowRow->getSubject();
                $workflowTitle = $strike->getContent();

            }*/


            $workflowTitle = $this->contentType->getSubject();  // $workflowRow->workflowNumber . ' ' . $workflowRow->subject;  // getSubject();



            $btn=new FavoriteButton($this);
            $btn->contentType=$this->contentType;

        } else {

            $formStatus = $this->contentType;
            $workflowStatus = $formStatus;
            $workflowTitle = $this->contentType->defaultTitle;  // 'Neu';

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

        if ($this->contentType->getDataId() !== null) {

            if ($this->contentType->hasView()) {
                $this->contentType->getView($layout->col3);
            }

        }

        $menu = new WorkflowLogMenu($layout->col1);
        $menu->process = $this->contentType;
        $menu->formStatus = $formStatus;
        $menu->currentStatus = $workflowStatus;
        $menu->redirectSite = $this->redirectSite;

        if ($formStatus !== null) {

            $subtitle = new AdminSubtitle($layout->col2);
            $subtitle->content = $formStatus->typeLabel;

            $form = new StatusFormContainer($layout->col2);
            $form->formStatus = $formStatus;
            $form->workflowStatus = $workflowStatus;
            $form->redirectSite = clone($this->redirectSite);
            $form->appendParameter = $this->appendParameter;

        }


        if ($this->contentType->getDataId() !== null) {


            //$btn = new FavoriteButton($layout->col3);
            //$btn->contentType = $this->contentType;


            $container = new WorkflowStreamContainer($layout->col3);
            $container->contentType = $this->contentType;

            $contentId = $this->contentType->getContentId();


            // child Container List auslagern

            $view = new FileParentContainer($layout->col3);
            $view->parentId = $contentId;


            $table = new SourceTable($layout->col3);
            $table->contentType = $this->contentType;


            $table = new ContentLogTable($layout->col3);
            $table->contentType = $this->contentType;


        }


        return parent::getContent();

    }

}