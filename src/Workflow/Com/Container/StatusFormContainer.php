<?php


namespace Nemundo\Process\Workflow\Com\Container;

use Nemundo\Html\Container\AbstractHtmlContainer;
use Nemundo\Html\Paragraph\Paragraph;
use Nemundo\Process\Group\Check\GroupRestrictedTrait;
use Nemundo\Process\Workflow\Content\Status\AbstractProcessStatus;
use Nemundo\Web\Site\AbstractSite;


class StatusFormContainer extends AbstractHtmlContainer
{

    /**
     * @var AbstractSite
     */
    public $redirectSite;

    /**
     * @var AbstractProcessStatus
     */
    public $formStatus;

    /**
     * @var AbstractProcessStatus
     */
    public $workflowStatus;


    public $appendParameter = false;

    public function getContent()
    {

        if ($this->formStatus !== null) {

            $showForm = true;

            if ($this->formStatus->isObjectOfTrait(GroupRestrictedTrait::class)) {
                if (!$this->formStatus->checkUserVisibility()) {
                    $showForm = false;
                }
            }

            if ($showForm) {
                $form = $this->formStatus->getForm($this);
                $form->redirectSite = $this->redirectSite;
                $form->appendParameter = $this->appendParameter;

            } else {
                $p = new Paragraph($this);
                $p->content = 'Keine Berechtigungen';
            }

        }

        return parent::getContent();

    }

}