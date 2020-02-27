<?php


namespace Nemundo\Process\App\Task\Setup;


use Nemundo\Core\Base\AbstractBase;
use Nemundo\Process\App\Assignment\Data\AssignmentSource\AssignmentSource;
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