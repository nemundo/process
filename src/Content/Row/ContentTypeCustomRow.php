<?php


namespace Nemundo\Process\Content\Row;

use Nemundo\Core\Debug\Debug;
use Nemundo\Core\Log\LogMessage;
use Nemundo\Process\Content\Data\ContentType\ContentTypeRow;
use Nemundo\Process\Content\Type\AbstractContentType;
use Nemundo\Process\Content\Type\MenuTrait;


class ContentTypeCustomRow extends ContentTypeRow
{

    public function getContentType($dataId=null)
    {

        $className = $this->phpClass;


        $contentType=null;
        if (class_exists($className)) {

        /** @var AbstractContentType|MenuTrait $contentType */
        $contentType = new $className($dataId);

           // (new Debug())->write($this->id);

        } else {
            (new LogMessage())->writeError('Content Type is not registred. Class: '.$className);
        }

        return $contentType;


    }

}