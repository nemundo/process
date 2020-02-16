<?php


namespace Nemundo\Process\Template\Content\Date;


use Nemundo\Package\Bootstrap\FormElement\BootstrapDatePicker;
use Nemundo\Process\Content\Form\AbstractContentForm;

abstract class AbstractDateContentForm extends AbstractContentForm
{


    /**
     * @var BootstrapDatePicker
     */
    protected $date;


    public function getContent()
    {


        $this->date = new BootstrapDatePicker($this);
        $this->date->label = '';

        // kein Autofocus setzen !!!


        return parent::getContent(); // TODO: Change the autogenerated stub
    }


    protected function onSubmit()
    {



        // TODO: Implement onSubmit() method.
    }

}