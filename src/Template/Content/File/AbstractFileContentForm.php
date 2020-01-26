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
        $this->file->multiUpload = true;

        parent::loadContainer();
    }

}