<?php


namespace Nemundo\Process\App\Assignment\Content\Message;


use Nemundo\Core\Debug\Debug;
use Nemundo\Core\Type\DateTime\Date;
use Nemundo\Process\App\Assignment\Content\AssignmentTrait;
use Nemundo\Process\Workflow\Content\Status\AbstractProcessStatus;
use Nemundo\Process\Workflow\Content\Status\ProcessStatusTrait;

class MessageAssignmentProcessStatus extends AbstractProcessStatus   // MessageAssignmentContentType
{

    use AssignmentTrait;
    //use ProcessStatusTrait;

    public $message;


    protected function loadContentType()
    {

        $this->typeLabel = 'Message Assignment Status';
        $this->typeId='be69437a-8e38-403e-8c4e-0a3ed075b0b6';

        $this->deadline = new Date();



    }


    protected function assignAssignment()
    {

        $this->saveAssignment();
        $process = $this->getParentProcess();

        $process->changeAssignment($this->groupId);
        $process->changeDeadline($this->deadline);

    }





}