<?php

namespace Nemundo\Process\Template\Form;


use Nemundo\App\Content\Form\AbstractContentTreeForm;
use Nemundo\Core\Type\DateTime\Date;
use Nemundo\Package\Bootstrap\FormElement\BootstrapDatePicker;
use Nemundo\Process\Form\AbstractStatusForm;
use Nemundo\Process\Item\WorkflowItem;
use Schleuniger\App\Task\Content\Type\Status\TerminVerschiebenStatus;

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

        //$taskRow = (new TaskReader())->getRowById($this->parentContentType->dataId);
        //$this->datum->value = $taskRow->deadline->getShortDateLeadingZeroFormat();

        /*
        if ($this->contentType->parentContentType->erledigenBis !== null) {
            $this->datum->value = $this->contentType->parentContentType->erledigenBis->getShortDateLeadingZeroFormat();
        } else {
            $this->datum->value = (new Date())->setNow()->getShortDateLeadingZeroFormat();
        }*/

        return parent::getContent();
    }



    protected function onSave()
    {

        $date = (new Date())->fromGermanFormat($this->datum->getValue());




        $item = new WorkflowItem($this->workflowId);
        $item->changeDeadline($date);

    }


    /*
    protected function onSubmit()
    {

        $status = new TerminVerschiebenStatus();
        $status->parentContentType = $this->parentContentType;
        $status->datum->fromGermanFormat($this->datum->getValue());
        $status->saveType();

    }*/

}