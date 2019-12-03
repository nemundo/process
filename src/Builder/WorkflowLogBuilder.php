<?php


namespace Nemundo\Process\Builder;


use Nemundo\Core\Type\DateTime\DateTime;
use Nemundo\User\Type\UserSessionType;
use Schleuniger\App\ChangeRequest\Data\Workflow\WorkflowUpdate;
use Schleuniger\App\ChangeRequest\Data\WorkflowLog\WorkflowLog;
use Nemundo\Process\Status\AbstractStatus;

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
        $data->mitarbeiterId = (new UserSessionType())->userId;
        $data->dateTime = (new DateTime())->setNow();
        $workflowLogId = $data->save();

        if ($this->status->changeStatus) {

            $update = new WorkflowUpdate();
            $update->statusId = $this->status->id;
            $update->updateById($this->workflowId);

        }

        return $workflowLogId;


    }


}