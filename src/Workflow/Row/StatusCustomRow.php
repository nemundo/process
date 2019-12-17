<?php


namespace Nemundo\Process\Workflow\Row;

// Nemundo\Process\Row\StatusCustomRow;

use Nemundo\Process\Workflow\Data\Status\StatusRow;
use Nemundo\Process\Workflow\Content\Status\AbstractStatus;

class StatusCustomRow extends StatusRow
{

    public function getStatus() {

        /** @var AbstractStatus $status */
        $status = $this->contentType->getContentType();

        return $status;

    }

}