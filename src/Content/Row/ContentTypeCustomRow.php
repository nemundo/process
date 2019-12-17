<?php


namespace Nemundo\Process\Content\Row;

use Nemundo\Process\Content\Data\ContentType\ContentTypeRow;
use Nemundo\Process\Content\Type\AbstractContentType;


class ContentTypeCustomRow extends ContentTypeRow
{

    public function getContentType()
    {

        $className = $this->phpClass;

        /** @var AbstractContentType $contentType */
        $contentType = new $className();

        return $contentType;


    }

}