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
    protected $file;


    protected function loadContainer()
    {

        $this->file = new BootstrapFileUpload($this);
        $this->file->label = 'File';
        $this->file->multiUpload = false;

        parent::loadContainer();

    }

    protected function onSubmit()
    {

        $this->contentType->file->fromFileRequest($this->file->getFileRequest());
        $this->contentType->saveType();

    }

}