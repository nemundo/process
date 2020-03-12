<?php


namespace Nemundo\Process\Template\Content\Image;


use Nemundo\Package\Bootstrap\Form\BootstrapForm;
use Nemundo\Package\Bootstrap\FormElement\BootstrapFileUpload;

class ImageUploadForm extends BootstrapForm
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

            $type = new ImageContentType();
            $type->fileRequest = $fileRequest;
            $type->saveType();

        }

    }

}