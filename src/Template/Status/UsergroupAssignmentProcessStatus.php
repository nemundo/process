<?php


namespace Nemundo\Process\Template\Status;


use Nemundo\Process\Workflow\Content\Status\AbstractProcessStatus;

class UsergroupAssignmentProcessStatus extends AbstractProcessStatus
{

    protected function loadContentType()
    {
   $this->label='Assignment (Usergroup)';
   $this->id = '90a77704-0677-45b4-abc2-cb4590701c81';
    }

}