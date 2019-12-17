<?php


namespace Nemundo\Process\Template\Item;


use Nemundo\Core\Random\UniqueId;
use Nemundo\Process\Data\Workflow\WorkflowUpdate;
use Nemundo\Process\Item\AbstractContentItem;
use Nemundo\Process\Item\AbstractStatusItem;
use Nemundo\Process\Template\Data\UserAssignmentLog\UserAssignmentLog;
use Nemundo\Process\Template\Status\UserAssignmentStatus;
use Nemundo\Workflow\App\Identification\Model\Identification;

class UserAssignmentItem extends AbstractContentItem
{

    public $userId;

    public function saveItem()
    {

        $this->contentType=new UserAssignmentStatus();

        $assignment = new Identification();
        $assignment->setUserIdentification($this->userId);

        $data = new UserAssignmentLog();
        $data->id=$this->dataId;
        $data->userId = $this->userId;
        $data->save();

        $this->saveContent();

        $update = new WorkflowUpdate();
        $update->assignment = $assignment;
        $update->updateById($this->parentId);

        $this->sendToInbox($this->userId);

    }

}