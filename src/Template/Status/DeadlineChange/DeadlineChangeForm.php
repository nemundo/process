<?php

namespace Nemundo\Process\Template\Status\DeadlineChange;


use Nemundo\Core\Debug\Debug;
use Nemundo\Core\Type\DateTime\Date;
use Nemundo\Package\Bootstrap\FormElement\BootstrapDatePicker;

use Nemundo\Process\Workflow\Content\Form\AbstractStatusForm;


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

        $process = $this->contentType->getParentProcess();
        if ($process->hasDeadline()) {
            $this->datum->value = $process->getDeadline()->getShortDateLeadingZeroFormat();
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