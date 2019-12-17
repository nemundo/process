<?php


namespace Nemundo\Process\Row;

// Nemundo\Process\Row\ContentTypeCustomRow

use Nemundo\Process\Content\AbstractContentType;
use Nemundo\Process\Content\Data\ContentType\ContentTypeRow;
use Nemundo\Process\Data\Status\StatusRow;
use Nemundo\Process\Status\AbstractStatus;

class ContentTypeCustomRow extends ContentTypeRow
{

    public function getContentType() {

        $className = $this->phpClass;

        /** @var AbstractContentType $contentType */
        $contentType = new $className();

        return $contentType;


    }

}