<?php


namespace Nemundo\Process\Content\Collection;


use Nemundo\Process\Content\Type\AbstractContentType;

class ContentTypeCollection extends AbstractContentTypeCollection
{

    protected function loadCollection()
    {

    }


    public function addContentType(AbstractContentType $contentType)
    {
        return parent::addContentType($contentType);
    }

}