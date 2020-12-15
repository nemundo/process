<?php
namespace Nemundo\Process\App\Task\Data;
use Nemundo\Model\Collection\AbstractModelCollection;
class TaskModelCollection extends AbstractModelCollection {
protected function loadCollection() {
$this->addModel(new \Nemundo\Process\App\Task\Data\TaskIndex\TaskIndexModel());
$this->addModel(new \Nemundo\Process\App\Task\Data\TaskType\TaskTypeModel());
}
}