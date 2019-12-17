<?php


namespace Nemundo\Process\Workflow\Content\Item\Status;


use Nemundo\Core\Base\AbstractBase;
use Nemundo\Core\Type\DateTime\DateTime;
use Nemundo\Process\Content\Data\Content\Content;
use Nemundo\Process\Content\Item\AbstractContentItem;
use Nemundo\Process\Workflow\Content\Status\AbstractStatus;
use Nemundo\Process\Workflow\Data\Status\StatusId;
use Nemundo\Process\Workflow\Data\Workflow\WorkflowUpdate;

use Nemundo\User\Type\UserSessionType;


// Step

// AbstractStatusLogBuilder

// AbstractProcessStatusItem
abstract class AbstractStatusItem extends AbstractContentItem
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

        $this->saveContent();

        if ($this->contentType->changeStatus) {

            $id = new StatusId();
            $id->filter->andEqual($id->model->contentTypeId,$this->contentType->id);
            $stausId = $id->getId();

            $update = new WorkflowUpdate();
            $update->statusId =$stausId;
            $update->updateById($this->parentId);
        }

        if ($this->contentType->closeWorkflow) {
            $update = new WorkflowUpdate();
            $update->workflowClosed =true;
            $update->updateById($this->parentId);
        }

    }

}