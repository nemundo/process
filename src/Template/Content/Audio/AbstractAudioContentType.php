<?php


namespace Nemundo\Process\Template\Content\Audio;



use Nemundo\Process\Template\Content\File\AbstractFileContentType;


abstract class AbstractAudioContentType extends AbstractFileContentType
{

    public function __construct($dataId = null)
    {
        $this->formClass=AudioContentForm::class;
        $this->viewClass=AudioContentView::class;


        parent::__construct($dataId);
    }

/*
    protected function loadContentType()
    {
        //$this->typeLabel='Audio';
        //$this->typeId='3c544600-86ec-42e1-b2e9-aeb349d56b28';

        $this->formClass=AudioContentForm::class;
        $this->viewClass=AudioContentView::class;

    }*/


    public function getSubject()
    {
        $subject='Audio';
        return $subject;
    }


}