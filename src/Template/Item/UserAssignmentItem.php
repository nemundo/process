<?php


namespace Nemundo\Process\Template\Item;


use Nemundo\Core\Random\UniqueId;

use Nemundo\Process\Content\Item\AbstractContentItem;
use Nemundo\Process\Template\Data\UserAssignmentLog\UserAssignmentLog;
use Nemundo\Process\Template\Status\UserAssignmentProcessStatus;
use Nemundo\Process\Workflow\Data\Workflow\WorkflowUpdate;
use Nemundo\Workflow\App\Identification\Model\Identification;


// UserAssignmentProcessItem
class UserAssignmentItem extends AbstractContentItem
{

    /**
     * @var string
     */
    public $userId;

    public function saveItem()
    {

        $this->contentType=new UserAssignmentProcessStatus();

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