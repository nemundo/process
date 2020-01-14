<?php


namespace Nemundo\Process\Content\Row;

use Nemundo\Core\Log\LogMessage;
use Nemundo\Process\Content\Data\Content\ContentRow;
use Nemundo\Process\Content\Type\AbstractContentType;
use Nemundo\Process\Content\Type\AbstractTreeContentType;
use Nemundo\Process\Content\Type\MenuTrait;
use Nemundo\Process\Content\Type\TreeContentType;

class ContentCustomRow extends ContentRow
{

    public function getContentType()
    {

        $className = $this->contentType->phpClass;

        $contentType = null;
        if (class_exists($className)) {

            /** @var AbstractContentType|AbstractTreeContentType|MenuTrait $contentType */
            $contentType = new $className($this->dataId);

            //$contentType = new $className($this->id);

        } else {

            (new LogMessage())->writeError('ContentCustomRow. Content Type is not registred. Class: ' . $className);
            $contentType = new TreeContentType($this->dataId);

        }

        return $contentType;

    }

}