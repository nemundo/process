<?php


namespace Nemundo\Process\Template\Content\Audio;


class AudioContentType extends AbstractAudioContentType
{

    protected function loadContentType()
    {

        $this->typeLabel = 'Audio';
        $this->typeId = '3c544600-86ec-42e1-b2e9-aeb349d56b28';

        $this->formClass = AudioContentForm::class;

    }

}