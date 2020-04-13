<?php


namespace Nemundo\Process\Template\Content\Audio;


use Nemundo\Html\Form\Input\AcceptFileType;
use Nemundo\Process\Template\Content\File\AbstractFileContentForm;


abstract class AbstractAudioContentForm extends AbstractFileContentForm
{

    protected function loadContainer()
    {

        parent::loadContainer();
        $this->image->acceptFileType = AcceptFileType::AUDIO;

    }

}