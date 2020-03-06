<?php


namespace Nemundo\Process\Template\Content\Text;


class TextContentType extends AbstractTextContentType
{

    public $text;

    protected function loadContentType()
    {

        $this->typeLabel = 'Text';
        $this->typeId = '00b2fd69-59de-4e2d-b829-640c142253eb';

    }

}