<?php


namespace Nemundo\Process\Builder;


use Nemundo\Core\Base\AbstractBase;
use Nemundo\Core\Type\DateTime\DateTime;
use Nemundo\Process\Data\Workflow\WorkflowUpdate;
use Nemundo\Process\Data\WorkflowLog\WorkflowLog;
use Nemundo\Process\Status\AbstractStatus;
use Nemundo\User\Type\UserSessionType;


// Step

// AbstractStatusLogBuilder
// AbstractStatusBuilder
abstract class AbstractStatusLogBuilder extends AbstractBase
{

    /**
     * @var string
     */
    public $workflowId;

    /**
     * @var AbstractStatus
     */
    protected $status;


    protected $dataId;


    /**
     * @var DateTime
     */
    protected $dateTime;

    protected $userId;



    abstract function saveStatus();

    public function __construct($workflowId)
    {
        $this->workflowId = $workflowId;

        $this->dateTime = (new DateTime())->setNow();
        $this->userId = (new UserSessionType())->userId;


    }


    protected function saveWorkflowLog()
    {

        $data = new WorkflowLog();
        $data->statusId = $this->status->id;
        $data->workflowId = $this->workflowId;
        $data->dataId = $this->dataId;
        $data->userId =$this->userId;
        $data->dateTime = $this->dateTime;
         $data->save();

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

    }


}