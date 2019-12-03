<?php


namespace Nemundo\Process\Form;


use Nemundo\Core\Log\LogMessage;
use Nemundo\Core\Type\DateTime\DateTime;
use Nemundo\Process\Builder\WorkflowLogBuilder;
use Nemundo\User\Type\UserSessionType;

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

        $workflowBuilder =new WorkflowLogBuilder();  // new WorkflowBuilder\ new WorkflowBuilder($this->workflowId);
        $workflowBuilder->status = $this->status;
        $workflowBuilder->workflowId=$this->workflowId;
        $workflowBuilder->dataId=$this->dataId;
          $workflowBuilder->saveLog();

        //saveLog($this->status, $this->dataId);

        //$this->workflowLogId = $workflowLogId;

        //return $workflowLogId;

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