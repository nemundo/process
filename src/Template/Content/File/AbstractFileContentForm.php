<?php


namespace Nemundo\Process\Template\Content\File;


use Nemundo\Package\Bootstrap\FormElement\BootstrapFileUpload;
use Nemundo\Process\Content\Form\AbstractContentForm;

abstract class AbstractFileContentForm extends AbstractContentForm
{

    /**
     * @var AbstractFileContentType
     */
    public $contentType;

    /**
     * @var BootstrapFileUpload
     */
    protected $image;


    protected function loadContainer()
    {

        $this->image = new BootstrapFileUpload($this);
        $this->image->label = 'File';
        $this->image->multiUpload = false;

        parent::loadContainer();

    }

    protected function onSubmit()
    {

        $this->contentType->file->fromFileRequest($this->image->getFileRequest());
        $this->contentType->saveType();

    }

}