<?php


namespace Nemundo\Process\Template\Content\Date;


use Nemundo\Package\Bootstrap\FormElement\BootstrapDatePicker;
use Nemundo\Process\Content\Form\AbstractContentForm;

abstract class AbstractDateContentForm extends AbstractContentForm
{

    /**
     * @var AbstractDateContentType
     */
    public $contentType;

    /**
     * @var BootstrapDatePicker
     */
    protected $date;

    protected function loadContainer()
    {
        parent::loadContainer();

        $this->date = new BootstrapDatePicker($this);
        $this->date->label = 'Date';

    }


    protected function onSubmit()
    {

        $this->contentType->date->fromGermanFormat($this->date->getValue());
        $this->contentType->saveType();

    }

}