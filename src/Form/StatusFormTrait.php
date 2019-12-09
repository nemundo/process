<?php


namespace Nemundo\Process\Form;


use Nemundo\Process\Builder\StatusLogBuilder;
use Nemundo\Process\Builder\WorkflowLogBuilder;
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

        $workflowBuilder = new StatusLogBuilder($this->workflowId);  // new WorkflowLogBuilder();
        $workflowBuilder->status = $this->status;
        $workflowBuilder->workflowId = $this->workflowId;
        $workflowBuilder->dataId = $this->dataId;
        $workflowBuilder->saveStatus();  //saveLog();

    }


    /*
        public function updateDataId()
        {

            if ($this->dataId == null) {
                (new LogMessage())->writeError('No DataId');
            }

            $update = new WorkflowLogUpdate();
            $update->dataId = $this->dataId;
            $update->updateById($this->workflowLogId);

        }*/


}