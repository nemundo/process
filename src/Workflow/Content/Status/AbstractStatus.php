<?php


namespace Nemundo\Process\Workflow\Content\Status;



// AbstractProcessStatus
use Nemundo\Process\Content\Type\AbstractContentType;

abstract class AbstractStatus extends AbstractContentType
{

    use ProcessStatusTrait;

}