<?php


namespace Nemundo\Process\Template\Item;


use Nemundo\Core\Random\UniqueId;

use Nemundo\Process\Content\Item\AbstractContentItem;
use Nemundo\Process\Template\Data\UserAssignmentLog\UserAssignmentLog;
use Nemundo\Process\Template\Data\UserAssignmentLog\UserAssignmentLogReader;
use Nemundo\Process\Template\Status\UserAssignmentProcessStatus;
use Nemundo\Process\Workflow\Content\Item\Status\AbstractStatusItem;
use Nemundo\Process\Workflow\Data\Workflow\WorkflowUpdate;
use Nemundo\Workflow\App\Assignment\Builder\AssignmentBuilder;
use Nemundo\Workflow\App\Identification\Model\Identification;



// UserAssignmentProcessItem
class UserAssignmentItem extends AbstractStatusItem  // AbstractContentItem
{

    /**
     * @var string
     */
    public $userId;


    protected function saveData()
    {

        $this->contentType=new UserAssignmentProcessStatus();

        $assignment = new Identification();
        $assignment->setUserIdentification($this->userId);

        $data = new UserAssignmentLog();
        $data->id=$this->dataId;
        $data->userId = $this->userId;
        $data->save();

        //$this->saveContent();

        $update = new WorkflowUpdate();
        $update->assignment = $assignment;
        $update->updateById($this->parentId);

        //$this->sendToInbox($this->userId);


        //

        /*
        $builder = new AssignmentBuilder($this->parentContentType);
        $builder->archiveAssignment();
        $builder->assignment->identificationType = new MitarbeiterIdentificationType();
        $builder->assignment->identificationId = $this->userId;
        $builder->message = 'ECR Zuweisung';
        $builder->createAssignment();*/



    }


    public function getSubject()
    {

        /* $item = $this->getItem($dataId);
         $parentId = $item->getParentId();
         $text = $item->getParentContentType()->getSubject($parentId);

         $text.=': ';*/



        $reader = new UserAssignmentLogReader();
        $reader->model->loadUser();
        $row = $reader->getRowById($this->dataId);
        $text = 'Assign to ' . $row->user->displayName;

        return $text;

    }


}