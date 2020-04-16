<?php


namespace Nemundo\Process\Template\Content\File;


use Nemundo\Package\Bootstrap\Form\BootstrapForm;
use Nemundo\Package\Bootstrap\FormElement\BootstrapFileUpload;
use Nemundo\Process\Content\Form\AbstractContentForm;
use Nemundo\Process\Template\Data\TemplateWebFile\TemplateWebFile;

class WebFileContentForm extends BootstrapForm  // AbstractContentForm
{

    /**
     * @var AbstractFileContentType
     */
    public $contentType;

    /**
     * @var BootstrapFileUpload
     */
    private $file;

    public function getContent()
    {

        $this->file = new BootstrapFileUpload($this);
        $this->file->label = 'File';
        //$this->file->multiUpload = true;

        return parent::getContent();
    }


    protected function onSubmit()
    {

        $data = new TemplateWebFile();
        $data->file->fromFileRequest($this->file->getFileRequest());
        $data->save();


            //$type = clone($this->contentType);  // new FileContentType();
            //$type->parentId = $this->contentType->getParentId();
            //$type->file->fromFileRequest($fileRequest);
            //$type->saveType();

    }

}