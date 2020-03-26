<?php


namespace Nemundo\Process\App\Task\Setup;


use Nemundo\Process\App\Task\Data\TaskType\TaskType;
use Nemundo\Process\App\Task\Data\TaskType\TaskTypeDelete;
use Nemundo\Process\App\Task\Data\TaskType\TaskTypeUpdate;
use Nemundo\Process\Content\Setup\AbstractContentTypeSetup;
use Nemundo\Process\Content\Type\AbstractContentType;

class TaskSetup extends AbstractContentTypeSetup
{

    public function addTaskType(AbstractContentType $contentType)
    {

        parent::addContentType($contentType);

        $data = new TaskType();
        $data->updateOnDuplicate = true;
        $data->taskTypeId = $contentType->typeId;
        $data->setupStatus = true;
        $data->save();

        return $this;

    }


    public function resetSetupStatus()
    {


        $update = new TaskTypeUpdate();
        $update->setupStatus = false;
        $update->update();

    }


    public function removeUnused()
    {

        $delete = new TaskTypeDelete();
        $delete->filter->andEqual($delete->model->setupStatus, false);
        $delete->delete();

    }


}