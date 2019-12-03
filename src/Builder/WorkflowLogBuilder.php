<?php


namespace Nemundo\Process\Builder;


use Nemundo\Core\Type\DateTime\DateTime;
use Nemundo\Process\Data\Workflow\WorkflowUpdate;
use Nemundo\Process\Data\WorkflowLog\WorkflowLog;
use Nemundo\User\Type\UserSessionType;

use Nemundo\Process\Status\AbstractStatus;


// StatusLogBuilder
class WorkflowLogBuilder
{

    /**
     * @var AbstractStatus
     */
    public $status;

    /**
     * @var string
     */
    public $workflowId;

    public $dataId;

    public function saveLog() {

        $data = new WorkflowLog();
        $data->statusId = $this->status->id;
        $data->workflowId = $this->workflowId;
        $data->dataId = $this->dataId;
        $data->userId = (new UserSessionType())->userId;
        //$data->mitarbeiterId = (new UserSessionType())->userId;
        $data->dateTime = (new DateTime())->setNow();
        $workflowLogId = $data->save();

        if ($this->status->changeStatus) {

            $update = new WorkflowUpdate();
            $update->statusId = $this->status->id;
            $update->updateById($this->workflowId);
        }


        if ($this->status->closeWorkflow) {

            $update = new WorkflowUpdate();
            $update->workflowClosed =true;
            $update->updateById($this->workflowId);
        }


        //return $workflowLogId;


    }


}