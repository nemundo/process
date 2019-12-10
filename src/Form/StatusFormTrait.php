<?php


namespace Nemundo\Process\Form;


use Nemundo\Process\Builder\StatusLogBuilder;
use Nemundo\Process\Status\AbstractStatus;

trait StatusFormTrait
{

    /**
     * @var string
     */
    public $workflowId;

    /**
     * @var string
     */
    public $dataId;

    /**
     * @var AbstractStatus
     */
    public $status;

    /**
     * @var int
     */
    private $workflowLogId;


    protected function saveWorkflowLog()
    {

        $workflowBuilder = new StatusLogBuilder($this->workflowId);
        $workflowBuilder->status = $this->status;
        $workflowBuilder->workflowId = $this->workflowId;
        $workflowBuilder->dataId = $this->dataId;
        $workflowBuilder->saveStatus();

    }


}