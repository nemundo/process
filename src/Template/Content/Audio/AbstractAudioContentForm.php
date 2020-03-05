<?php


namespace Nemundo\Process\Template\Content\Audio;


use Nemundo\Html\Form\Input\AcceptFileType;
use Nemundo\Package\Bootstrap\FormElement\BootstrapFileUpload;
use Nemundo\Process\Content\Form\AbstractContentForm;
use Nemundo\Process\Template\Content\File\AbstractFileContentForm;


abstract class AbstractAudioContentForm extends AbstractFileContentForm
{

    protected function loadContainer()
    {
        parent::loadContainer();

        //$this->file->label = 'Audio';
        $this->file->acceptFileType = AcceptFileType::AUDIO;

    }

}