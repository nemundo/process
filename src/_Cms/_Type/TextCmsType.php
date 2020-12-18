<?php


namespace Nemundo\Process\Cms\Type;


use Nemundo\Process\Cms\Index\CmsIndexTrait;
use Nemundo\Process\Template\Content\Text\TextContentType;

class TextCmsType extends TextContentType
{

    use CmsIndexTrait;

    protected function loadContentType()
    {

        parent::loadContentType();
        $this->typeLabel = 'Text (Cms)';
        $this->typeId = '26e9ff93-54b2-4653-97ed-ccec72ee2c9c';

    }


    protected function onFinished()
    {

        parent::onFinished();
        $this->saveCmsIndex();

    }


}