<?php


namespace Nemundo\Process\Builder;


use Nemundo\Core\Base\AbstractBase;
use Nemundo\Process\Status\AbstractStatus;


// Step
abstract class AbstractStatusBuilder extends AbstractBase
{

    protected $workflowId;

    /**
     * @var AbstractStatus
     */
    protected $status;

    abstract function createStatusStep();

    public function __construct($workflowId)
    {
        $this->workflowId = $this;
    }

}