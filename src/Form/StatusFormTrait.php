<?php


namespace Nemundo\Process\Form;


use Nemundo\Core\Log\LogMessage;
use Nemundo\Core\Type\DateTime\DateTime;
use Nemundo\User\Type\UserSessionType;
use Schleuniger\App\ChangeRequest\Data\Workflow\WorkflowUpdate;
use Schleuniger\App\ChangeRequest\Data\WorkflowLog\WorkflowLog;
use Schleuniger\App\ChangeRequest\Data\WorkflowLog\WorkflowLogUpdate;
use Nemundo\Process\Builder\WorkflowBuilder;
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

        $workflowBuilder = new WorkflowBuilder($this->workflowId);
        $workflowLogId=  $workflowBuilder->saveLog($this->status, $this->dataId);

        $this->workflowLogId = $workflowLogId;

        return $workflowLogId;

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