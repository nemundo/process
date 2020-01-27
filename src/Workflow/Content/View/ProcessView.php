<?php


namespace Nemundo\Process\Workflow\Content\View;


use Nemundo\Admin\Com\Table\AdminLabelValueTable;
use Nemundo\Admin\Com\Title\AdminTitle;
use Nemundo\Admin\Com\Widget\AdminWidget;
use Nemundo\Com\FormBuilder\RedirectTrait;
use Nemundo\Com\Html\Listing\UnorderedList;
use Nemundo\Core\Debug\Debug;
use Nemundo\Html\Formatting\Strike;
use Nemundo\Html\Paragraph\Paragraph;
use Nemundo\Process\Content\Com\Table\SourceTable;
use Nemundo\Process\Content\View\AbstractContentView;
use Nemundo\Process\Group\Type\GroupContentType;
use Nemundo\Process\Template\Content\File\FileParentContainer;
use Nemundo\Process\Workflow\Com\Container\StatusFormContainer;
use Nemundo\Process\Workflow\Com\Container\WorkflowStreamContainer;
use Nemundo\Process\Workflow\Com\Layout\WorkflowLayout;
use Nemundo\Process\Workflow\Com\Menu\ProcessMenu;
use Nemundo\Process\Workflow\Com\Table\WorkflowLogTable;
use Nemundo\Process\Workflow\Parameter\StatusParameter;
use Nemundo\ToDo\Data\ToDo\ToDoRow;
use Schleuniger\App\Aufgabe\Content\Process\AufgabeParentContainer;


class ProcessView extends AbstractProcessView
{

    public function getContent()
    {

        //$p=new Paragraph($this);
        //$p->content=$this->contentType->getClassName();


        $workflowStatus = null;
        $formStatus = null;
        $workflowTitle = null;

        if ($this->dataId !== null) {


            //(new Debug())->write('load');


            /** @var ToDoRow $workflowRow */
            $workflowRow = $this->contentType->getDataRow();  // $this->contentType->getWorkflowRow();

            //(new Debug())->write($workflowRow->status->contentType);

            $workflowStatus = $workflowRow->status->getContentType();

            $workflowStatus->parentId = $this->dataId;

            $formStatus = (new StatusParameter())->getStatus();

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


            $workflowTitle =  $workflowRow->workflowNumber.' '.$workflowRow->subject;  // getSubject();


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


            /*
            $table = new AdminLabelValueTable($layout->col3);
            $table->addLabelValue($workflowRow->model->workflowNumber->label, $workflowRow->workflowNumber);
            $table->addLabelValue($workflowRow->model->subject->label, $workflowRow->subject);
            //$table->addLabelValue($model->assignment->label, $workflowRow->assignment->getValue());
            $table->addLabelValue($workflowRow->model->assignment->label, $workflowRow->assignment->group);

            $table->addLabelValue($workflowRow->model->assignment->groupType->label, $workflowRow->assignment->groupType->contentType);

            $ul = new UnorderedList();

            $group = new GroupContentType($workflowRow->assignmentId);
            foreach ($group->getUserList() as $userRow) {
                $ul->addText($userRow->login);
            }
            $table->addLabelCom('Member', $ul);

            $table->addLabelValue($workflowRow->model->status->label, $workflowRow->status->contentType);
            $table->addLabelYesNoValue($workflowRow->model->workflowClosed->label, $workflowRow->workflowClosed);


            if ($workflowRow->deadline !== null) {
                $table->addLabelValue($workflowRow->model->deadline->label, $workflowRow->deadline->getShortDateLeadingZeroFormat());
            }

            $table->addLabelValue($workflowRow->model->dateTime->label, $workflowRow->dateTime->getShortDateTimeLeadingZeroFormat());
            $table->addLabelValue($workflowRow->model->user->label, $workflowRow->user->displayName);
*/



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
            $form->redirectSite = clone($this->redirectSite);
            $form->appendParameter =$this->appendParameter;
            if ($this->dataId !== null) {
                $form->parentId = $this->contentType->getContentId();
            }
            //$form->appendWorkflowParameter = $this->appendWorkflowParameter;
        }




        if ($this->dataId !== null) {


            //$btn = new FavoriteButton($layout->col3);
            //$btn->contentType = $this->contentType;


            $container = new WorkflowStreamContainer($layout->col2);
            $container->contentType = $this->contentType;



            $contentId = $this->contentType->getContentId();


            // child Container List auslagern

            $view = new FileParentContainer($layout->col3);
            $view->parentId = $contentId;

            $container = new AufgabeParentContainer($layout->col3);
            $container->parentId = $contentId;



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