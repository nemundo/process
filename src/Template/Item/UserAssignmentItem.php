<?php


namespace Nemundo\Process\Template\Item;


use Nemundo\Core\Random\UniqueId;

use Nemundo\Process\Content\Item\AbstractContentItem;
use Nemundo\Process\Template\Data\UserAssignmentLog\UserAssignmentLog;
use Nemundo\Process\Template\Status\UserAssignmentProcessStatus;
use Nemundo\Process\Workflow\Data\Workflow\WorkflowUpdate;
use Nemundo\Workflow\App\Assignment\Builder\AssignmentBuilder;
use Nemundo\Workflow\App\Identification\Model\Identification;
use Schleuniger\App\Org\Identification\MitarbeiterIdentificationType;


// UserAssignmentProcessItem
class UserAssignmentItem extends AbstractContentItem
{

    /**
     * @var string
     */
    public $mitarbeiterId;




    public function saveItem()
    {

        $this->contentType=new UserAssignmentProcessStatus();

        $assignment = new Identification();
        $assignment->setUserIdentification($this->mitarbeiterId);

        $data = new UserAssignmentLog();
        $data->id=$this->dataId;
        $data->userId = $this->mitarbeiterId;
        $data->save();

        $this->saveContent();

        $update = new WorkflowUpdate();
        $update->assignment = $assignment;
        $update->updateById($this->parentId);

        $this->sendToInbox($this->mitarbeiterId);


        //

        /*
        $builder = new AssignmentBuilder($this->parentContentType);
        $builder->archiveAssignment();
        $builder->assignment->identificationType = new MitarbeiterIdentificationType();
        $builder->assignment->identificationId = $this->userId;
        $builder->message = 'ECR Zuweisung';
        $builder->createAssignment();*/



    }

}