<?php


namespace Nemundo\Process\App\Assignment\Content;


use Nemundo\Core\Type\DateTime\Date;
use Nemundo\Process\Workflow\Content\Status\AbstractProcessStatus;
use Nemundo\Process\Workflow\Content\Status\ProcessStatusTrait;

abstract class AbstractAssignmentProcessStatus extends AbstractProcessStatus
{

    use AssignmentTrait;

    public function __construct($dataId = null)
    {
        $this->deadline=new Date();
        parent::__construct($dataId);
    }

}