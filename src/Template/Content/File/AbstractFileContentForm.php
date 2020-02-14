<?php


namespace Nemundo\Process\Template\Content\File;


use Nemundo\Package\Bootstrap\FormElement\BootstrapFileUpload;
use Nemundo\Process\Content\Form\AbstractContentForm;
use Nemundo\Process\Template\Content\File\FileContentType;
use Nemundo\Process\Template\Data\TemplateFile\TemplateFile;

abstract class AbstractFileContentForm extends AbstractContentForm
{

    /**
     * @var BootstrapFileUpload
     */
    protected $file;


    protected function loadContainer()
    {

        $this->file = new BootstrapFileUpload($this);
        $this->file->label = 'File';
        $this->file->multiUpload = false;  // true;

        parent::loadContainer();
    }

    protected function onSubmit()
    {


            //$type = new AudioContentType();
            $this->contentType->parentId = $this->parentId;
            $this->contentType->fileRequest = $this->file->getFileRequest();
            $this->contentType->saveType();

     //   }

    }

}