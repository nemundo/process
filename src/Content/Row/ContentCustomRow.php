<?php


namespace Nemundo\Process\Content\Row;

use Nemundo\Core\Debug\Debug;
use Nemundo\Core\Log\LogMessage;
use Nemundo\Process\Content\Data\Content\ContentRow;
use Nemundo\Process\Content\Data\ContentType\ContentTypeRow;
use Nemundo\Process\Content\Type\AbstractContentType;
use Nemundo\Process\Content\Type\AbstractTreeContentType;
use Nemundo\Process\Content\Type\MenuTrait;


class ContentCustomRow extends ContentRow
{

    public function getContentType()
    {
        //(new Debug())->write($this->id);
        $className = $this->contentType->phpClass;

        $contentType=null;
        if (class_exists($className)) {

        /** @var AbstractContentType|AbstractTreeContentType|MenuTrait $contentType */
        $contentType = new $className($this->id);

        } else {
            (new LogMessage())->writeError('Content Type is not registred. Class: '.$className);
        }

        return $contentType;


    }

}