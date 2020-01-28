<?php


namespace Nemundo\Process\Workflow\Row;


trait WorkflowCustomRowTrait
{

    public function getSubject()
    {

        $subject = $this->workflowNumber . ' ' . $this->subject;
        return $subject;

    }

    public function getCreator()
    {

        $creator = $this->user->login . ' ' . $this->dateTime->getShortDateLeadingZeroFormat();
        return $creator;

    }


    public function getDeadline() {


        $deadline = '';
        if ($this->deadline !==null) {
            $deadline=   $this->deadline->getShortDateLeadingZeroFormat();
        }


        return $deadline;

    }



}