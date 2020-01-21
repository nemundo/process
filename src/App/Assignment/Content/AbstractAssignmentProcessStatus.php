<?php


namespace Nemundo\Process\App\Assignment\Content;


use Nemundo\Process\Workflow\Content\Status\AbstractProcessStatus;
use Nemundo\Process\Workflow\Content\Status\ProcessStatusTrait;

abstract class AbstractAssignmentProcessStatus extends AbstractProcessStatus
{

    use AssignmentTrait;


}