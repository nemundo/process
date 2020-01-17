<?php


namespace Nemundo\Process\App\Assignment\Status;


class CancelAssignmentStatus extends AbstractAssignmentStatus
{
    protected function loadStatus()
    {
        $this->id=3;
        $this->status='Cancel';
        // TODO: Implement loadStatus() method.
    }

}