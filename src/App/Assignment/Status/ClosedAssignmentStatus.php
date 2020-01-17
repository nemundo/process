<?php


namespace Nemundo\Process\App\Assignment\Status;


class ClosedAssignmentStatus extends AbstractAssignmentStatus
{
    protected function loadStatus()
    {
        $this->id=2;
        $this->status='Closed';
        // TODO: Implement loadStatus() method.
    }

}