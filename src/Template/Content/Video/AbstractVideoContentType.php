<?php


namespace Nemundo\Process\Template\Content\Video;


use Nemundo\Process\Template\Content\File\AbstractFileContentType;


abstract class AbstractVideoContentType extends AbstractFileContentType
{

    public function __construct($dataId = null)
    {

        $this->formClass = VideoContentForm::class;
        $this->viewClass = VideoContentView::class;
        $this->typeLabel = 'Video';
        parent::__construct($dataId);

    }


    public function getSubject()
    {
        $subject = 'Video';
        return $subject;
    }

}