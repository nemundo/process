<?php


namespace Nemundo\Process\App\Assignment\Content\Message;


use Nemundo\Core\Debug\Debug;
use Nemundo\Process\App\Assignment\Content\AssignmentTrait;
use Nemundo\Process\Workflow\Content\Status\AbstractProcessStatus;
use Nemundo\Process\Workflow\Content\Status\ProcessStatusTrait;

class MessageAssignmentProcessStatus extends AbstractProcessStatus   // MessageAssignmentContentType
{

    use AssignmentTrait;
    //use ProcessStatusTrait;

    public $message;

    protected function assignAssignment()
    {

        $this->saveAssignment();
        $process = $this->getParentProcess();

        $process->changeAssignment($this->groupId);
        $process->changeDeadline($this->deadline);

    }

}