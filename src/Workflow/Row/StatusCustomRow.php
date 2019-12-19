<?php


namespace Nemundo\Process\Workflow\Row;

// Nemundo\Process\Row\StatusCustomRow;

use Nemundo\Process\Workflow\Data\Status\StatusRow;
use Nemundo\Process\Workflow\Content\Status\AbstractProcessStatus;

class StatusCustomRow extends StatusRow
{

    public function getStatus() {

        /** @var AbstractProcessStatus $status */
        $status = $this->contentType->getContentType();

        return $status;

    }

}