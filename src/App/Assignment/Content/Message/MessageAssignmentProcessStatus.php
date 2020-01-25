<?php


namespace Nemundo\Process\App\Assignment\Content\Message;


use Nemundo\Core\Debug\Debug;
use Nemundo\Process\Workflow\Content\Status\ProcessStatusTrait;

class MessageAssignmentProcessStatus extends MessageAssignmentContentType
{

    use ProcessStatusTrait;

    protected function assignAssignment()
    {

        parent::assignAssignment();

        $process = $this->getParentProcess();

        //(new Debug())->write($process->getDataId());

        //(new Debug())->write($process->getSubject());

        $process->changeAssignment($this->groupId);
        $process->changeDeadline($this->deadline);

    }

}