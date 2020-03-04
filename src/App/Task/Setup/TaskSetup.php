<?php


namespace Nemundo\Process\App\Task\Setup;


use Nemundo\Process\App\Task\Data\TaskType\TaskType;
use Nemundo\Process\Content\Setup\AbstractContentTypeSetup;
use Nemundo\Process\Content\Type\AbstractContentType;

class TaskSetup extends AbstractContentTypeSetup
{

    public function addTaskType(AbstractContentType $contentType)
    {

        parent::addContentType($contentType);

        $data = new TaskType();
        $data->ignoreIfExists = true;
        $data->taskTypeId = $contentType->typeId;
        $data->save();

        return $this;

    }

}