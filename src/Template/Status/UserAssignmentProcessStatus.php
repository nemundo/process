<?php


namespace Nemundo\Process\Template\Status;


use Nemundo\Core\Language\LanguageCode;
use Nemundo\Process\Template\Data\UserAssignmentLog\UserAssignmentLog;
use Nemundo\Process\Template\Data\UserAssignmentLog\UserAssignmentLogReader;
use Nemundo\Process\Template\Form\UserAssignmentForm;
use Nemundo\Process\Template\Item\UserAssignmentItem;
use Nemundo\Process\Workflow\Content\Process\WorkflowProcess;
use Nemundo\Process\Workflow\Content\Status\AbstractProcessStatus;
use Nemundo\Process\Workflow\Data\Workflow\WorkflowUpdate;
use Nemundo\Workflow\App\Identification\Model\Identification;

class UserAssignmentProcessStatus extends AbstractProcessStatus
{

    protected function loadContentType()
    {

        $this->contentLabel[LanguageCode::EN] = 'Assignment (User)';
        $this->contentLabel[LanguageCode::DE] = 'Zuweisung an';
        $this->contentId = '3ca6ccea-7eb0-4a5c-945c-9c0da28e0cc1';
        $this->formClass = UserAssignmentForm::class;
        //$this->itemClass=UserAssignmentItem::class;
        $this->changeStatus = false;

    }


    protected function onCreate()
    {

        $assignment = new Identification();
        $assignment->setUserIdentification($this->userId);

        $data = new UserAssignmentLog();
        $data->id=$this->dataId;
        $data->userId = $this->userId;
        $data->save();


        $process = new WorkflowProcess($this->dataId);
        $process->changeAssignment($assignment);

       /* $update = new WorkflowUpdate();
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