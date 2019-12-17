<?php


namespace Nemundo\Process\Builder;


use Nemundo\Core\Base\AbstractBase;
use Nemundo\Core\Type\DateTime\DateTime;
use Nemundo\Process\Content\Data\Content\Content;
use Nemundo\Process\Data\Status\StatusId;
use Nemundo\Process\Data\Workflow\WorkflowUpdate;
use Nemundo\Process\Data\WorkflowLog\WorkflowLog;
use Nemundo\Process\Item\AbstractContentItem;
use Nemundo\Process\Status\AbstractStatus;
use Nemundo\User\Type\UserSessionType;


// Step

// AbstractStatusLogBuilder
// AbstractStatusBuilder
abstract class AbstractStatusLogBuilder extends AbstractContentItem  // AbstractBase
{

    /**
     * @var string
     */
    //public $parentId;

    /**
     * @var AbstractStatus
     */
    public $contentType;


    //protected $dataId;


    /**
     * @var DateTime
     */
    protected $dateTime;

    protected $userId;



  //  abstract function saveStatus();


    /*
    public function __construct($workflowId)
    {
        $this->workflowId = $workflowId;

        $this->dateTime = (new DateTime())->setNow();
        $this->userId = (new UserSessionType())->userId;


    }*/


    protected function saveWorkflowLog()
    {

        /*
        $data = new WorkflowLog();
        $data->statusId = $this->status->id;
        $data->workflowId = $this->workflowId;
        $data->dataId = $this->dataId;
        $data->userId =$this->userId;
        $data->dateTime = $this->dateTime;
         $data->save();*/

        /*$data = new Content();
        $data->contentTypeId = $this->status->id;
        $data->parentId = $this->workflowId;
        $data->dataId = $this->dataId;
        $data->userCreatedId =$this->userId;
        $data->dateTimeCreated = $this->dateTime;
        $data->save();*/

       // $this->parentId = $this->parentId;
       // $this->contentType = $this->contentType;

        $this->saveContent();


        if ($this->contentType->changeStatus) {

            $id = new StatusId();
            $id->filter->andEqual($id->model->contentTypeId,$this->contentType->id);
            $stausId = $id->getId();


            $update = new WorkflowUpdate();
            $update->statusId =$stausId;  // $this->status->id;
            $update->updateById($this->parentId);
        }

        if ($this->contentType->closeWorkflow) {
            $update = new WorkflowUpdate();
            $update->workflowClosed =true;
            $update->updateById($this->parentId);
        }

    }


}