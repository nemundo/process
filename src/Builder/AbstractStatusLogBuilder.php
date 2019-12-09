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

    /*
    protected $workflowId;

    /**
     * @var AbstractStatus
     */
    protected $status;


    protected $dataId;


    /**
     * @var DateTime
     */
    public $dateTime;

    public $userId;


    //abstract function createStatusItem();

    abstract function saveStatus();

    public function __construct($workflowId)
    {
        $this->workflowId = $workflowId;

        $this->dateTime = (new DateTime())->setNow();
        $this->userId = (new UserSessionType())->userId;


    }


    protected function saveWorkflowLog()
    {

        /*$workflowBuilder = new WorkflowLogBuilder();
        $workflowBuilder->status = $this->status;
        $workflowBuilder->workflowId = $this->workflowId;
        $workflowBuilder->dataId = $this->dataId;
        $workflowBuilder->saveLog();*/

        $data = new WorkflowLog();
        $data->statusId = $this->status->id;
        $data->workflowId = $this->workflowId;
        $data->dataId = $this->dataId;
        $data->userId =$this->userId;  // (new UserSessionType())->userId;
        //$data->mitarbeiterId = (new UserSessionType())->userId;
        $data->dateTime = $this->dateTime;  // (new DateTime())->setNow();
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