<?php
namespace Nemundo\Process\App\Task\Data\TaskType;
class TaskTypeModel extends \Nemundo\Model\Definition\Model\AbstractModel {
/**
* @var \Nemundo\Model\Type\Id\IdType
*/
public $id;

/**
* @var \Nemundo\Model\Type\External\Id\ExternalUniqueIdType
*/
public $taskTypeId;

/**
* @var \Nemundo\Process\Content\Data\ContentType\ContentTypeExternalType
*/
public $taskType;

protected function loadModel() {
$this->tableName = "process_task_type";
$this->aliasTableName = "process_task_type";
$this->label = "Task Type";

$this->primaryIndex = new \Nemundo\Db\Index\AutoIncrementIdPrimaryIndex();

$this->id = new \Nemundo\Model\Type\Id\IdType($this);
$this->id->tableName = "process_task_type";
$this->id->fieldName = "id";
$this->id->aliasFieldName = "process_task_type_id";
$this->id->label = "Id";
$this->id->allowNullValue = false;
$this->id->visible->form = false;
$this->id->visible->table = false;
$this->id->visible->view = false;
$this->id->visible->form = false;

$this->taskTypeId = new \Nemundo\Model\Type\External\Id\ExternalUniqueIdType($this);
$this->taskTypeId->tableName = "process_task_type";
$this->taskTypeId->fieldName = "task_type";
$this->taskTypeId->aliasFieldName = "process_task_type_task_type";
$this->taskTypeId->label = "Task Type";
$this->taskTypeId->allowNullValue = false;

$index = new \Nemundo\Model\Definition\Index\ModelUniqueIndex($this);
$index->indexName = "task_type";
$index->addType($this->taskTypeId);

}
public function loadTaskType() {
if ($this->taskType == null) {
$this->taskType = new \Nemundo\Process\Content\Data\ContentType\ContentTypeExternalType($this, "process_task_type_task_type");
$this->taskType->tableName = "process_task_type";
$this->taskType->fieldName = "task_type";
$this->taskType->aliasFieldName = "process_task_type_task_type";
$this->taskType->label = "Task Type";
}
return $this;
}
}