<?php


namespace Nemundo\Process\Template\Content\File;


use Nemundo\Package\Bootstrap\FormElement\BootstrapFileUpload;
use Nemundo\Process\Content\Form\AbstractContentForm;
use Nemundo\Process\Template\Content\File\FileContentType;
use Nemundo\Process\Template\Data\TemplateFile\TemplateFile;

class FileContentForm extends AbstractContentForm
{

    /**
     * @var BootstrapFileUpload
     */
    private $file;

    public function getContent()
    {

        $this->file = new BootstrapFileUpload($this);
        $this->file->label = 'File';
        $this->file->multiUpload = true;

        return parent::getContent();
    }


    protected function onSubmit()
    {

        foreach ($this->file->getMultiFileRequest() as $fileRequest) {

            $type = new FileContentType();
            $type->parentId = $this->contentType->getParentId();
            //$type->parentId = $this->parentId;
            $type->fileRequest = $fileRequest;
            $type->saveType();

        }


    }

}