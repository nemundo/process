<?php
namespace Nemundo\Process\App\Task\Data\TaskType;
class TaskTypeExternalType extends \Nemundo\Model\Type\External\ExternalType {
/**
* @var \Nemundo\Model\Type\Id\IdType
*/
public $id;

/**
* @var \Nemundo\Model\Type\Id\IdType
*/
public $taskTypeId;

/**
* @var \Nemundo\Process\Content\Data\ContentType\ContentTypeExternalType
*/
public $taskType;

/**
* @var \Nemundo\Model\Type\Number\YesNoType
*/
public $setupStatus;

protected function loadExternalType() {
parent::loadExternalType();
$this->externalModelClassName = TaskTypeModel::class;
$this->externalTableName = "process_task_type";
$this->aliasTableName = $this->parentFieldName . "_" . $this->externalTableName;
$this->id = new \Nemundo\Model\Type\Id\IdType();
$this->id->fieldName = "id";
$this->id->tableName = $this->parentFieldName . "_" . $this->externalTableName;
$this->id->aliasFieldName = $this->id->tableName . "_" . $this->id->fieldName;
$this->id->label = "Id";
$this->addType($this->id);

$this->taskTypeId = new \Nemundo\Model\Type\Id\IdType();
$this->taskTypeId->fieldName = "task_type";
$this->taskTypeId->tableName = $this->parentFieldName . "_" . $this->externalTableName;
$this->taskTypeId->aliasFieldName = $this->taskTypeId->tableName ."_".$this->taskTypeId->fieldName;
$this->taskTypeId->label = "Task Type";
$this->addType($this->taskTypeId);

$this->setupStatus = new \Nemundo\Model\Type\Number\YesNoType();
$this->setupStatus->fieldName = "setup_status";
$this->setupStatus->tableName = $this->parentFieldName . "_" . $this->externalTableName;
$this->setupStatus->aliasFieldName = $this->setupStatus->tableName . "_" . $this->setupStatus->fieldName;
$this->setupStatus->label = "Setup Status";
$this->addType($this->setupStatus);

}
public function loadTaskType() {
if ($this->taskType == null) {
$this->taskType = new \Nemundo\Process\Content\Data\ContentType\ContentTypeExternalType(null, $this->parentFieldName . "_task_type");
$this->taskType->fieldName = "task_type";
$this->taskType->tableName = $this->parentFieldName . "_" . $this->externalTableName;
$this->taskType->aliasFieldName = $this->taskType->tableName ."_".$this->taskType->fieldName;
$this->taskType->label = "Task Type";
$this->addType($this->taskType);
}
return $this;
}
}