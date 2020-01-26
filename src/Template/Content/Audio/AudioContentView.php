<?php


namespace Nemundo\Process\Template\Content\Audio;


use Nemundo\Html\Multimedia\AudioPlayer;
use Nemundo\Process\Template\Content\File\AbstractFileContentView;

class AudioContentView extends AbstractFileContentView
{

    public function getContent()
    {

        $fileRow = $this->contentType->getDataRow();

        $video = new AudioPlayer($this);
        $video->src = $fileRow->file->getUrl();

        return parent::getContent();

    }

}