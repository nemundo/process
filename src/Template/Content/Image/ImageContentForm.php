<?php

namespace Nemundo\Process\Template\Content\Image;


use Nemundo\Html\Form\Input\AcceptFileType;
use Nemundo\Package\Bootstrap\FormElement\BootstrapFileUpload;
use Nemundo\Process\Content\Form\AbstractContentForm;

class ImageContentForm extends AbstractContentForm
{

    /**
     * @var BootstrapFileUpload
     */
    private $image;

    public function getContent()
    {

        $this->image = new BootstrapFileUpload($this);
        $this->image->label = 'File';
        $this->image->multiUpload = true;
        $this->image->acceptFileType = AcceptFileType::IMAGE;

        return parent::getContent();
    }


    protected function onSubmit()
    {

        foreach ($this->image->getMultiFileRequest() as $fileRequest) {

            $type = new ImageContentType();
            $type->parentId = $this->parentId;
            $type->fileRequest = $fileRequest;
            $type->saveType();

        }


    }

}