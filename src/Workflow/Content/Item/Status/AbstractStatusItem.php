<?php


namespace Nemundo\Process\Workflow\Content\Item\Status;


use Nemundo\Core\Base\AbstractBase;
use Nemundo\Core\Type\DateTime\DateTime;
use Nemundo\Process\Content\Data\Content\Content;
use Nemundo\Process\Content\Item\AbstractContentItem;
use Nemundo\Process\Workflow\Content\Status\AbstractProcessStatus;
use Nemundo\Process\Workflow\Data\Status\StatusId;
use Nemundo\Process\Workflow\Data\Workflow\WorkflowUpdate;

use Nemundo\User\Type\UserSessionType;




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





    protected function saveWorkflowLog()
    {

        $this->saveContent();

        if ($this->contentType->changeStatus) {

            /*$id = new StatusId();
            $id->filter->andEqual($id->model->contentTypeId,$this->contentType->id);
            $stausId = $id->getId();*/

            $update = new WorkflowUpdate();
            $update->statusId = $this->contentType->id;  //   $stausId;
            $update->updateById($this->parentId);
        }

        if ($this->contentType->closeWorkflow) {
            $update = new WorkflowUpdate();
            $update->workflowClosed =true;
            $update->updateById($this->parentId);
        }

    }

}