<?php


namespace Nemundo\Process\Workflow\Com\Container;

use Nemundo\Html\Container\AbstractHtmlContainer;
use Nemundo\Html\Paragraph\Paragraph;
use Nemundo\Process\Group\Check\GroupRestrictionTrait;
use Nemundo\Process\Workflow\Content\Status\AbstractProcessStatus;
use Nemundo\Web\Site\AbstractSite;


class StatusFormContainer extends AbstractHtmlContainer
{

    /**
     * @var string
     */
    //public $parentId;

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

            //$subtitle = new AdminSubtitle($this);
            //$subtitle->content = $this->formStatus->contentLabel;

            $showForm = true;

            //if ($this->formStatus->isObjectOfTrait(UserRestrictionTrait::class)) {
            if ($this->formStatus->isObjectOfTrait(GroupRestrictionTrait::class)) {
                if (!$this->formStatus->checkUserVisibility()) {
                    $showForm = false;
                }
            }

            //$showForm = false;

            if ($showForm) {
                $form = $this->formStatus->getForm($this);
                //$form->contentType = $this->formStatus;
                //$form->parentId = $this->parentId;
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