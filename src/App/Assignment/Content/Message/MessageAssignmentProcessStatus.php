<?php


namespace Nemundo\Process\App\Assignment\Content\Message;


use Nemundo\Process\Workflow\Content\Status\ProcessStatusTrait;

class MessageAssignmentProcessStatus extends MessageAssignmentContentType
{

    use ProcessStatusTrait;

    protected function assignAssignment()
    {

        parent::assignAssignment();

        $process = $this->getParentProcess();
        $process->changeAssignment($this->groupId);
        $process->changeDeadline($this->deadline);

    }

}