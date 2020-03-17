<?php


namespace Nemundo\Process\Template\Content\LargeText;


use Nemundo\Package\Bootstrap\FormElement\BootstrapLargeTextBox;
use Nemundo\Process\Content\Form\AbstractContentForm;

class LargeTextContentForm extends AbstractLargeTextContentForm  // AbstractContentForm
{

    /**
     * @var AbstractLargeTextContentType
     */
    //public $contentType;

    /**
     * @var BootstrapLargeTextBox
     */
    //private $largeText;

    /*
    public function getContent()
    {

        $this->largeText = new BootstrapLargeTextBox($this);
        $this->largeText->label =$this->contentType->typeLabel;

        return parent::getContent();

    }*/


    /*
    protected function loadUpdateForm()
    {

        $this->largeText->value = $this->contentType->getDataRow()->largeText;

    }*/


    /*
    protected function onSubmit()
    {

        $this->contentType->fromDataId($this->dataId);
        $this->contentType->largeText = $this->largeText->getValue();
        $this->contentType->saveType();

    }*/

}