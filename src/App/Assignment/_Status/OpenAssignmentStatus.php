<?php


namespace Nemundo\Process\App\Assignment\Status;


class OpenAssignmentStatus extends AbstractAssignmentStatus
{
    protected function loadStatus()
    {
        $this->id=1;
        $this->status='Open';
        // TODO: Implement loadStatus() method.
    }

}