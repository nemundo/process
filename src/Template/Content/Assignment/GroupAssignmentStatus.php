<?php


namespace Nemundo\Process\Template\Content\Assignment;


use Nemundo\Process\Template\Data\GroupAssignment\GroupAssignment;
use Nemundo\Process\Template\Data\GroupAssignment\GroupAssignmentReader;
use Nemundo\Process\Workflow\Content\Status\AbstractProcessStatus;
use Nemundo\Process\Workflow\Data\Workflow\WorkflowUpdate;
use Schleuniger\App\GlobalGroup\Data\GlobalGroupAssignment\GlobalGroupAssignment;

class GroupAssignmentStatus extends AbstractProcessStatus
{

    public $groupId;

    protected function loadContentType()
    {
        $this->contentLabel = 'Group Assignment';
        $this->contentId = 'e4368eda-9bb4-4610-9595-7ad9e86272ba';
        $this->changeStatus = false;
        $this->formClass = GroupAssignmentForm::class;

    }

    protected function onCreate()
    {

        $data=new GroupAssignment();
        $data->id=$this->dataId;
        $data->groupId=$this->groupId;
        $data->save();

        $update = new WorkflowUpdate();
        $update->groupAssignmentId = $this->groupId;
        $update->updateById($this->parentId);

    }


    public function getSubject()
    {

        $reader=new GroupAssignmentReader();
        $reader->model->loadGroup();
        $row=$reader->getRowById($this->dataId);
        $subject= 'Group Assignment to : '.$row->group->group;

        return $subject;

    }


}