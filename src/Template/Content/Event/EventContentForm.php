<?php


namespace Nemundo\Process\Template\Content\Event;


use Nemundo\Package\Bootstrap\FormElement\BootstrapDatePicker;
use Nemundo\Package\Bootstrap\FormElement\BootstrapTextBox;
use Nemundo\Process\Content\Form\AbstractContentForm;

class EventContentForm extends AbstractContentForm
{


    /**
     * @var BootstrapDatePicker
     */
    private $date;

    /**
     * @var BootstrapTextBox
     */
    private $event;



    public function getContent()
    {

        $this->date=new BootstrapDatePicker($this);
        $this->date->label = 'Date';

        $this->event=new BootstrapTextBox($this);
        $this->event->label='Event';

        return parent::getContent(); // TODO: Change the autogenerated stub
    }


    protected function loadUpdateForm()
    {

        $eventRow = (new EventContentType($this->dataId))->getDataRow();

        $this->date->value=$eventRow->date->getShortDateLeadingZeroFormat();
        $this->event->value=$eventRow->event;

    }

    protected function onSubmit()
    {

        $type=new EventContentType($this->dataId);
        $type->parentId=$this->parentId;
        $type->date->fromGermanFormat($this->date->getValue());
        $type->event= $this->event->getValue();
        $type->saveType();


    }
}