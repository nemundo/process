<?php


namespace Nemundo\Process\App\Task\Index;


use Nemundo\Db\Sql\Order\SortOrder;
use Nemundo\Process\App\Task\Data\TaskIndex\TaskIndex;
use Nemundo\Process\App\Task\Data\TaskIndex\TaskIndexDelete;
use Nemundo\Process\App\Task\Data\TaskIndex\TaskIndexUpdate;
use Nemundo\Process\Content\Data\Tree\TreeReader;
use Nemundo\Process\Content\Row\ContentCustomRow;

trait TaskIndexTrait
{

    abstract protected function getAssignmentId();

    abstract protected function getDeadline();

    abstract protected function isTaskClosed();

    abstract protected function getCreatedDateTime();

    abstract protected function getCreatedUserId();


    protected function saveTaskIndex()
    {


        // getCount

        $reader = new TreeReader();
        $reader->model->loadChild();
        $reader->model->child->loadContentType();
        $reader->model->child->loadUser();
        $reader->filter->andEqual($reader->model->parentId, $this->getContentId());
        $reader->addOrder($reader->model->itemOrder);

        $message = '';
        foreach ($reader->getData() as $treeRow) {
            $message = $treeRow->child->subject;
        }



        //$message = $this->getLast()->getContentType()->getMessage();

        //$message = '[no message]';


        $update = new TaskIndexUpdate();
        $update->updateStatus=false;
        $update->filter->andEqual($update->model->contentId,$this->getContentId());
        $update->update();


        if ($this->getParentCount() == 0) {

            $data = new TaskIndex();
            $data->updateOnDuplicate = true;
            $data->hasSource=false;
            $data->contentId = $this->getContentId();
            $data->subject = $this->getSubject();
            $data->assignmentId = $this->getAssignmentId();
            $data->deadline = $this->getDeadline();
            $data->message = $message;
            $data->userId = $this->getCreatedUserId();
            $data->dateTime = $this->getCreatedDateTime();
            $data->closed = $this->isTaskClosed();
            $data->taskTypeId = $this->typeId;
            $data->updateStatus = true;
            $data->save();


        } else {

            foreach ($this->getParentContent() as $parentContentRow) {

                $data = new TaskIndex();
                $data->updateOnDuplicate = true;
                $data->hasSource=true;
                $data->sourceId = $parentContentRow->id;
                $data->contentId = $this->getContentId();
                $data->subject = $this->getSubject();
                $data->assignmentId = $this->getAssignmentId();
                $data->deadline = $this->getDeadline();
                $data->message = $message;
                // nicht überschreiben !!!
                $data->userId = $this->userId;
                $data->dateTime = $this->dateTime;

                $data->closed = $this->isTaskClosed();
                $data->taskTypeId = $this->typeId;
                $data->updateStatus = true;
                $data->save();

            }

        }
        // update all content id (ohne sourceId)


        $delete=new TaskIndexDelete();
        $delete->filter->andEqual($delete->model->contentId,$this->getContentId());
        $delete->filter->andEqual($delete->model->updateStatus,false);
        $delete->delete();

    }



    protected function deleteTaskIndex() {

        $delete=new TaskIndexDelete();
        $delete->filter->andEqual($delete->model->contentId,$this->getContentId());
        $delete->delete();

    }



}