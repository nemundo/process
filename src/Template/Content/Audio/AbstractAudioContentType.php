<?php


namespace Nemundo\Process\Template\Content\Audio;



use Nemundo\Process\Template\Content\File\AbstractFileContentType;


abstract class AbstractAudioContentType extends AbstractFileContentType
{

    public function __construct($dataId = null)
    {

        $this->formClass=AudioContentForm::class;

        parent::__construct($dataId);

        $this->viewClass=AudioContentView::class;

    }


    public function getSubject()
    {
        $subject='Audio';
        return $subject;
    }


}