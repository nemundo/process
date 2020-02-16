<?php


namespace Nemundo\Process\Template\Content\Audio;


use Nemundo\Html\Form\Input\AcceptFileType;
use Nemundo\Process\Template\Content\File\AbstractFileContentForm;


class AudioContentForm extends AbstractFileContentForm
{

    public function getContent()
    {

        $this->file->label = 'Audio';
        $this->file->acceptFileType = AcceptFileType::AUDIO;

        return parent::getContent();
    }


    protected function onSubmit()
    {

        $type = new AudioContentType();
        $type->parentId = $this->parentId;
        $type->fileRequest = $this->file->getFileRequest();
        $type->saveType();

    }

}