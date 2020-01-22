<?php


namespace Nemundo\Process\Template\Content\Video;


use Nemundo\Process\Template\Content\File\AbstractFileContentType;


class VideoContentType extends AbstractFileContentType
{

    protected function loadContentType()
    {
        $this->typeLabel='Video';
        $this->typeId='254a1fcf-052f-4989-b10f-1d605eacb923';

        $this->formClass=VideoContentForm::class;
        $this->viewClass=VideoContentView::class;

    }


    public function getSubject()
    {
        $subject='Video';
        return $subject;
    }


}