<?php

namespace Nemundo\Process\Template\Form;


use Nemundo\Core\Type\DateTime\Date;
use Nemundo\Package\Bootstrap\FormElement\BootstrapDatePicker;
use Nemundo\Process\Template\Item\DeadlineChangeItem;
use Nemundo\Process\Workflow\Content\Form\AbstractStatusForm;
use Nemundo\Process\Workflow\Content\Item\Process\WorkflowItem;

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


        $workflowItem = new WorkflowItem($this->parentId);
        if ($workflowItem->hasDeadline()) {
            $this->datum->value = $workflowItem->getDeadline()->getShortDateLeadingZeroFormat();
        }


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


    protected function onSubmit()
    {


        $item = new DeadlineChangeItem();
        $item->parentId = $this->parentId;
        $item->deadline = (new Date())->fromGermanFormat($this->datum->getValue());
        $item->saveItem();


    }


}