<?php


namespace Nemundo\Process\Template\Status;


use Nemundo\Process\Status\AbstractStatus;

class ReopenStatus extends AbstractStatus
{

    protected function loadContentType()
    {

        //$this->changeStatus=true;
        $this->label = 'Reopen';
        $this->id='a87e1038-8c01-4dae-af73-5334a6366a0f';

    }

}