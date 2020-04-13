<?php


namespace Nemundo\Process\Template\Content\Video;


class VideoContentForm extends AbstractVideoContentForm
{

    protected function loadContainer()
    {
        parent::loadContainer();
        $this->image->label = 'Video';

    }

}