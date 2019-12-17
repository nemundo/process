<?php


namespace Nemundo\Process\Row;


use Nemundo\Process\Data\Process\ProcessRow;
use Nemundo\Process\Process\AbstractProcess;


// Nemundo\Process\Row\ProcessCustomRow

class ProcessCustomRow extends ProcessRow
{

    public function getProcess() {

        //$className = $this->contentType->getContentType();processClass;

        /** @var AbstractProcess $process */
        $process =$this->contentType->getContentType();   //new $className();

        return $process;


    }

}