<?php


namespace Nemundo\Process\Template\Content\Audio;


class AudioContentForm extends AbstractAudioContentForm
{

    protected function loadContainer()
    {
        parent::loadContainer();
        $this->file->label = 'Audio';
    }

}