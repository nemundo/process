<?php



namespace Nemundo\Process\Com\Container;

use Nemundo\Admin\Com\Title\AdminSubtitle;
use Nemundo\Html\Container\AbstractHtmlContainer;
use Nemundo\Html\Paragraph\Paragraph;
use Nemundo\Process\Parameter\WorkflowParameter;
use Nemundo\Process\Status\AbstractStatus;
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
     * @var AbstractStatus
     */
    public $formStatus;

    /**
     * @var AbstractStatus
     */
    public $workflowStatus;


    public function getContent()
    {

        if ($this->formStatus !== null) {

            $subtitle = new AdminSubtitle($this);
            $subtitle->content = $this->formStatus->label;

            if ($this->formStatus->checkUserVisibility()) {

                /*if ($this->formStatus->id !== $this->workflowStatus->nextStatus->id) {
                    $this->formStatus->changeStatus=false;
                }*/

                $form = $this->formStatus->getForm($this);
                $form->workflowId = $this->workflowId;
                $form->status = $this->formStatus;
                $form->redirectSite =$this->site;

            } else {
                $p = new Paragraph($this);
                $p->content = 'Keine Berechtigungen';
            }

        }

        return parent::getContent();
    }

}