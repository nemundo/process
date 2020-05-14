<?php


namespace Nemundo\Process\Template\Content\Video;


use Nemundo\Html\Multimedia\Video;
use Nemundo\Process\Template\Content\File\AbstractFileContentView;

class VideoContentView extends AbstractFileContentView
{

    public function getContent()
    {

        $fileRow = $this->contentType->getDataRow();

        $video = new Video($this);
        $video->src = $fileRow->file->getUrl();
        $video->width = 800;

        return parent::getContent();

    }

}