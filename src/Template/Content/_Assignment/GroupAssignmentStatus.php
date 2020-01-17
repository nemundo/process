<?php


namespace Nemundo\Process\Template\Content\Assignment;


use Nemundo\Core\Type\DateTime\Date;
use Nemundo\Process\Template\Data\GroupAssignment\GroupAssignment;
use Nemundo\Process\Template\Data\GroupAssignment\GroupAssignmentReader;
use Nemundo\Process\Workflow\Content\Status\AbstractProcessStatus;

class GroupAssignmentStatus extends AbstractProcessStatus
{

    public $groupId;

    /**
     * @var Date
     */
    public $deadline;

    protected function loadContentType()
    {
        $this->typeLabel = 'Group Assignment';
        $this->typeId = 'e4368eda-9bb4-4610-9595-7ad9e86272ba';
        $this->changeStatus = false;
        $this->formClass = GroupAssignmentForm::class;

        $this->deadline=new Date();

    }

    protected function onCreate()
    {

        $data = new GroupAssignment();
        $data->groupId = $this->groupId;
        $data->deadline=$this->deadline;
        $data->sourceId=$this->parentId;
        $this->dataId = $data->save();


        /*
         $update = new WorkflowUpdate();
         $update->groupAssignmentId = $this->groupId;
         $update->updateById($this->parentId);*/

    }


    public function getSubject()
    {

        $reader = new GroupAssignmentReader();
        $reader->model->loadGroup();
        $row = $reader->getRowById($this->dataId);
        $subject = 'Group Assignment to : ' . $row->group->group;

        return $subject;

    }


}