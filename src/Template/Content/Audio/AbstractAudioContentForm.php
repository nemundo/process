<?php


namespace Nemundo\Process\Template\Content\Audio;


use Nemundo\Html\Form\Input\AcceptFileType;
use Nemundo\Package\Bootstrap\FormElement\BootstrapFileUpload;
use Nemundo\Process\Content\Form\AbstractContentForm;
use Nemundo\Process\Template\Content\File\AbstractFileContentForm;


abstract class AbstractAudioContentForm extends AbstractFileContentForm
{

    public function getContent()
    {

        $this->file->label = 'Audio';
        $this->file->acceptFileType = AcceptFileType::AUDIO;

        return parent::getContent();
    }


    /*
    protected function onSubmit()
    {

        foreach ($this->file->getMultiFileRequest() as $fileRequest) {

            $type = new AudioContentType();
            $type->parentId = $this->parentId;
            $type->fileRequest = $fileRequest;
            $type->saveType();

        }

    }*/

}