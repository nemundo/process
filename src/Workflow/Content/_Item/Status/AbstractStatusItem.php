<?php


namespace Nemundo\Process\Workflow\Content\Item\Status;


use Nemundo\Core\Type\DateTime\DateTime;
use Nemundo\Process\Content\Item\AbstractContentItem;
use Nemundo\Process\Workflow\Content\Status\AbstractProcessStatus;
use Nemundo\Process\Workflow\Data\Workflow\WorkflowUpdate;

// AbstractProcessStatusItem
abstract class AbstractStatusItem extends AbstractContentItem
{


    /**
     * @var AbstractProcessStatus
     */
    public $contentType;


    /**
     * @var DateTime
     */
    //protected $dateTime;

    //protected $userId;


    public function saveItem()
    {

        parent::saveItem();
        $this->saveWorkflowLog();


    }


    private function saveWorkflowLog()
    {

        //$this->saveContent();

        if ($this->contentType->changeStatus) {

            /*$id = new StatusId();
            $id->filter->andEqual($id->model->contentTypeId,$this->contentType->id);
            $stausId = $id->getId();*/

            $update = new WorkflowUpdate();
            $update->statusId = $this->contentType->typeId;  //   $stausId;
            $update->updateById($this->parentId);
        }

        if ($this->contentType->closeWorkflow) {
            $update = new WorkflowUpdate();
            $update->workflowClosed = true;
            $update->updateById($this->parentId);
        }

    }

}