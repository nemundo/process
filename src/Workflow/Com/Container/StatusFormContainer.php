<?php



namespace Nemundo\Process\Workflow\Com\Container;

use Nemundo\Admin\Com\Title\AdminSubtitle;
use Nemundo\Html\Container\AbstractHtmlContainer;
use Nemundo\Html\Paragraph\Paragraph;
use Nemundo\Process\Workflow\Content\Status\AbstractProcessStatus;
use Nemundo\Process\Workflow\Parameter\WorkflowParameter;

use Nemundo\Web\Site\AbstractSite;



class StatusFormContainer extends AbstractHtmlContainer
{

    /**
     * @var string
     */
    public $workflowId;

    /**
     * @var AbstractSite
     */
    public $site;

    /**
     * @var AbstractProcessStatus
     */
    public $formStatus;

    /**
     * @var AbstractProcessStatus
     */
    public $workflowStatus;


    public $appendWorkflowParameter=false;

    public function getContent()
    {

        if ($this->formStatus !== null) {

            $subtitle = new AdminSubtitle($this);
            $subtitle->content = $this->formStatus->label;

            if ($this->formStatus->checkUserVisibility()) {

                $form = $this->formStatus->getForm($this);
                $form->contentType= $this->formStatus;
                $form->parentId = $this->workflowId;
                //$form->workflowId = $this->workflowId;
                //$form->status = $this->formStatus;
                $form->redirectSite =$this->site;
                $form->appendParameter=$this->appendWorkflowParameter;

            } else {
                $p = new Paragraph($this);
                $p->content = 'Keine Berechtigungen';
            }

        }

        return parent::getContent();
    }

}