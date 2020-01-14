<?php


namespace Nemundo\Process\Template\Status;


use Nemundo\Process\Workflow\Content\Status\AbstractProcessStatus;

class ReopenProcessStatus extends AbstractProcessStatus
{

    protected function loadContentType()
    {

        //$this->changeStatus=true;
        $this->typeLabel = 'Reopen';
        $this->typeId='a87e1038-8c01-4dae-af73-5334a6366a0f';

    }

}