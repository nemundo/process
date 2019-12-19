<?php


namespace Nemundo\Process\Content\Row;

use Nemundo\Core\Log\LogMessage;
use Nemundo\Process\Content\Data\ContentType\ContentTypeRow;
use Nemundo\Process\Content\Type\AbstractContentType;


class ContentTypeCustomRow extends ContentTypeRow
{

    public function getContentType()
    {

        $className = $this->phpClass;


        $contentType=null;
        if (class_exists($className)) {

        /** @var AbstractContentType $contentType */
        $contentType = new $className();

        } else {
            (new LogMessage())->writeError('Content Type is not registred. Class: '.$className);
        }

        return $contentType;


    }

}