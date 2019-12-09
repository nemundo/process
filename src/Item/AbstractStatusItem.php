<?php


namespace Nemundo\Process\Item;


use Nemundo\Core\Base\AbstractBase;
use Nemundo\Process\Status\AbstractStatus;


abstract class AbstractStatusItem extends AbstractBase
{

    protected $workflowId;

    /**
     * @var AbstractStatus
     */
    protected $status;


    protected $dataId;


    abstract function createStatusItem();

    public function __construct($workflowId)
    {
        $this->workflowId = $workflowId;
    }


    protected function saveWorkflowLog()
    {

        $workflowBuilder = new WorkflowLogBuilder();
        $workflowBuilder->status = $this->status;
        $workflowBuilder->workflowId = $this->workflowId;
        $workflowBuilder->dataId = $this->dataId;
        $workflowBuilder->saveLog();

    }


}