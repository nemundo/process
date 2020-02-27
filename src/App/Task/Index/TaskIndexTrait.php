<?php


namespace Nemundo\Process\App\Task\Index;


use Nemundo\Process\App\Task\Data\TaskIndex\TaskIndex;

trait TaskIndexTrait
{


    abstract protected function getAssignmentId();
    abstract protected function getDeadline();
    abstract protected function isClosed();



    protected function saveTaskIndex() {

        $data=new TaskIndex();
        $data->updateOnDuplicate=true;
        $data->contentId=$this->getContentId();
        $data->subject=$this->getSubject();
        $data->assignmentId=$this->getAssignmentId();
        $data->deadline=$this->getDeadline();

        // nicht überschreiben !!!
        $data->userId=$this->userId;
        $data->dateTime=$this->dateTime;
        $data->closed = $this->isClosed();
        $data->taskTypeId=$this->typeId;
        $data->save();




    }

}