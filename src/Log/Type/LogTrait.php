<?php


namespace Nemundo\Process\Log\Type;


trait LogTrait
{

    public function getLog() {


        return $this->getSubject();

    }


}