<?php


namespace Nemundo\Process\App\Task\Index;


use Nemundo\Process\App\Task\Data\TaskIndex\TaskIndex;
use Nemundo\Process\App\Task\Data\TaskIndex\TaskIndexDelete;
use Nemundo\Process\App\Task\Data\TaskIndex\TaskIndexUpdate;

trait TaskIndexTrait
{


    abstract protected function getAssignmentId();

    abstract protected function getDeadline();

    abstract protected function isClosed();


    protected function saveTaskIndex()
    {


        // getCount


        $update = new TaskIndexUpdate();
        $update->updateStatus=false;
        $update->filter->andEqual($update->model->contentId,$this->getContentId());
        $update->update();


        if ($this->getParentCount() == 0) {


            $data = new TaskIndex();
            $data->updateOnDuplicate = true;
            //$data->sourceId= $parentContentRow->id;  //contentRow-> ->getparentId;  //  $this->getParentId();
            $data->contentId = $this->getContentId();
            $data->subject = $this->getSubject();
            $data->assignmentId = $this->getAssignmentId();
            $data->deadline = $this->getDeadline();

            // nicht überschreiben !!!
            $data->userId = $this->userId;
            $data->dateTime = $this->dateTime;

            $data->closed = $this->isClosed();
            $data->taskTypeId = $this->typeId;
            $data->updateStatus = true;
            $data->save();


        } else {

            foreach ($this->getParentContent() as $parentContentRow) {


                //(new Debug())->write($parentContentRow->id);

                $data = new TaskIndex();
                $data->updateOnDuplicate = true;
                $data->sourceId = $parentContentRow->id;  //contentRow-> ->getparentId;  //  $this->getParentId();
                $data->contentId = $this->getContentId();
                $data->subject = $this->getSubject();
                $data->assignmentId = $this->getAssignmentId();
                $data->deadline = $this->getDeadline();

                // nicht überschreiben !!!
                $data->userId = $this->userId;
                $data->dateTime = $this->dateTime;

                $data->closed = $this->isClosed();
                $data->taskTypeId = $this->typeId;
                $data->updateStatus = true;
                $data->save();

            }

        }
        // update all content id (ohne sourceId)


        $delete=new TaskIndexDelete();
        $delete->filter->andEqual($update->model->contentId,$this->getContentId());
        $delete->filter->andEqual($update->model->updateStatus,false);
        $delete->delete();

    }

}