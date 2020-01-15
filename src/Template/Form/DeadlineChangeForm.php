<?php

namespace Nemundo\Process\Template\Form;


use Nemundo\Core\Debug\Debug;
use Nemundo\Core\Type\DateTime\Date;
use Nemundo\Package\Bootstrap\FormElement\BootstrapDatePicker;
use Nemundo\Process\Template\Status\DeadlineChangeProcessStatus;
use Nemundo\Process\Workflow\Content\Form\AbstractStatusForm;
use Nemundo\Process\Workflow\Content\Process\WorkflowProcess;

class DeadlineChangeForm extends AbstractStatusForm
{

    /**
     * @var BootstrapDatePicker
     */
    private $datum;

    public function getContent()
    {

        $this->datum = new BootstrapDatePicker($this);
        $this->datum->label = 'Datum';
        $this->datum->validation = true;

        $workflowItem = $this->contentType->getParentProcess();
        if ($workflowItem->hasDeadline()) {
            $this->datum->value = $workflowItem->getDeadline()->getShortDateLeadingZeroFormat();
        }

        return parent::getContent();
    }


    protected function onSubmit()
    {

        $status = new DeadlineChangeProcessStatus();
        $status->parentId = $this->parentId;
        $status->deadline = (new Date())->fromGermanFormat($this->datum->getValue());
        $status->saveType();

    }

}