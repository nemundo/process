<?php


namespace Nemundo\Process\Template\Status;


use Nemundo\Process\Status\AbstractStatus;
use Nemundo\Process\Template\Form\UserAssignmentForm;

class UserAssignmentStatus extends AbstractStatus
{

    protected function loadStatus()
    {

        $this->label = 'Assignment (User)';
        $this->id='3ca6ccea-7eb0-4a5c-945c-9c0da28e0cc1';
        $this->formClass=UserAssignmentForm::class;
        $this->changeStatus=false;

    }

}