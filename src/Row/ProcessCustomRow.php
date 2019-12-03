<?php


namespace Nemundo\Process\Row;


use Nemundo\Process\Data\Process\ProcessRow;
use Nemundo\Process\Process\AbstractProcess;


// Nemundo\Process\Row\ProcessCustomRow

class ProcessCustomRow extends ProcessRow
{

    public function getProcess() {

        $className = $this->processClass;

        /** @var AbstractProcess $process */
        $process = new $className();

        return $process;


    }

}