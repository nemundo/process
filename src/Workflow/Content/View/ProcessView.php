<?php


namespace Nemundo\Process\Workflow\Content\View;


use Nemundo\Admin\Com\Title\AdminSubtitle;
use Nemundo\Admin\Com\Title\AdminTitle;
use Nemundo\Admin\Com\Widget\AdminWidget;
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
use Schleuniger\App\Aufgabe\Content\Process\AufgabeParentContainer;


class ProcessView extends AbstractProcessView
{

    /**
     * @var AbstractProcess
     */
    public $contentType;

    public function getContent()
    {

        $title=new AdminTitle($this);
        $title->content='ORGINAK';

        $workflowStatus = null;
        $formStatus = null;
        $workflowTitle = null;

        if ($this->dataId !== null) {

            /** @var ToDoRow $workflowRow */
            $workflowRow = $this->contentType->getDataRow();

            $workflowStatus = $workflowRow->status->getContentType();

            $workflowStatus->parentId = $this->dataId;

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


            $workflowTitle = $workflowRow->workflowNumber . ' ' . $workflowRow->subject;  // getSubject();


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

        if ($this->dataId !== null) {

            if ($this->contentType->hasView()) {
                $this->contentType->getView($layout->col3);
            }

        }


        /*
        $table = new AdminTable($layout->col1);
        foreach ($this->contentType->getChild() as $contentRow) {
            $row = new TableRow($table);
            new CheckIcon($row);
            $row->addText($contentRow->contentType->contentType);
        }*/


        $menu = new WorkflowLogMenu($layout->col1);
        $menu->process = $this->contentType;
        $menu->formStatus = $formStatus;
        $menu->currentStatus = $workflowStatus;
        $menu->redirectSite=$this->redirectSite;


        /*
        (new Br($layout->col1));
        (new Br($layout->col1));
        (new Br($layout->col1));


        $p=new Paragraph($layout->col1);
        $p->content='--- old version ---';

        $menu = new ProcessMenu($layout->col1);
        $menu->process = $this->contentType;
        $menu->workflowId = $this->dataId;
        $menu->formStatus = $formStatus;
        $menu->workflowStatus = $workflowStatus;
        $menu->site = clone($this->redirectSite);


        $menu=new NextMenu($layout->col1);
        $menu->contentType= $workflowStatus;*/


        if ($formStatus !== null) {
            //$widget = new AdminWidget($layout->col2);
            //$widget->widgetTitle = $formStatus->typeLabel;

            $subtitle = new AdminSubtitle($layout->col2);
            $subtitle->content = $formStatus->typeLabel;

            $form = new StatusFormContainer($layout->col2);
            $form->formStatus = $formStatus;
            $form->workflowStatus = $workflowStatus;
            $form->redirectSite = clone($this->redirectSite);
            $form->appendParameter = $this->appendParameter;
            if ($this->dataId !== null) {
                $form->parentId = $this->contentType->getContentId();
            }
        }


        if ($this->dataId !== null) {


            //$btn = new FavoriteButton($layout->col3);
            //$btn->contentType = $this->contentType;


            $container = new WorkflowStreamContainer($layout->col3);
            $container->contentType = $this->contentType;

            $contentId = $this->contentType->getContentId();


            // child Container List auslagern

            $view = new FileParentContainer($layout->col3);
            $view->parentId = $contentId;

            //$container = new AufgabeParentContainer($layout->col3);
            //$container->parentId = $contentId;


            $table = new SourceTable($layout->col3);
            $table->contentType = $this->contentType;

            //$btn = new AdminEventButton($layout->col3);
            //$btn->content = 'History anzeigen (Toggle)';

            $table = new ContentLogTable($layout->col3);
            $table->contentType = $this->contentType;


        }


        /*
         * Problem mit Durchlaufzeit
        $log = new WebLogContentType();
        $log->parentId = $this->contentType->getContentId();
        $log->saveType();
*/


        return parent::getContent();

    }

}