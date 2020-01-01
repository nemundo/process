<?php


namespace Nemundo\Process\Template\Content\Assignment;


use Nemundo\Process\Template\Data\GroupAssignment\GroupAssignment;
use Nemundo\Process\Template\Data\GroupAssignment\GroupAssignmentReader;
use Nemundo\Process\Workflow\Content\Item\Status\AbstractStatusItem;
use Nemundo\Process\Workflow\Data\Workflow\WorkflowUpdate;

class GroupAssignmentItem extends AbstractStatusItem
{

    public $groupId;

    protected function saveData()
    {

        $this->contentType=new GroupAssignmentStatus();

        $data=new GroupAssignment();
        $data->id=$this->dataId;
        $data->groupId=$this->groupId;
        $data->save();


        $update = new WorkflowUpdate();
        $update->groupAssignmentId = $this->groupId;
        $update->updateById($this->parentId);


        // TODO: Implement saveData() method.
    }


    public function getSubject()
    {

        $reader=new GroupAssignmentReader();
        $reader->model->loadGroup();
        $row=$reader->getRowById($this->dataId);
        $subject= 'Zuweisung an: '.$row->group->group;

        return $subject;

    }

}