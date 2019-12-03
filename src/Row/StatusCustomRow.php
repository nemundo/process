<?php


namespace Nemundo\Process\Row;

// Nemundo\Process\Row\StatusCustomRow;

use Nemundo\Process\Data\Status\StatusRow;
use Nemundo\Process\Status\AbstractStatus;

class StatusCustomRow extends StatusRow
{

    public function getStatus() {

        $className = $this->statusClass;

        /** @var AbstractStatus $status */
        $status = new $className();

        return $status;


    }

}