<?php


namespace Nemundo\Process\Template\Content\Audio;


use Nemundo\Html\Multimedia\Audio;
use Nemundo\Process\Template\Content\File\AbstractFileContentView;

class AudioContentView extends AbstractFileContentView
{

    public function getContent()
    {

        $fileRow = $this->contentType->getDataRow();

        $video = new Audio($this);
        $video->src = $fileRow->file->getUrl();

        return parent::getContent();

    }

}