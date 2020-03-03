<?php
namespace Nemundo\Process\App\Task\Data\Task;
class TaskExternalType extends \Nemundo\Model\Type\External\ExternalType {
/**
* @var \Nemundo\Model\Type\Id\IdType
*/
public $id;

/**
* @var \Nemundo\Model\Type\Id\IdType
*/
public $sourceId;

/**
* @var \Nemundo\Process\Content\Data\Content\ContentExternalType
*/
public $source;

/**
* @var \Nemundo\Model\Type\Id\IdType
*/
public $assignmentId;

/**
* @var \Nemundo\Process\Group\Data\Group\GroupExternalType
*/
public $assignment;

/**
* @var \Nemundo\Model\Type\DateTime\DateType
*/
public $deadline;

/**
* @var \Nemundo\Model\Type\Text\TextType
*/
public $task;

/**
* @var \Nemundo\Model\Type\Number\YesNoType
*/
public $closed;

protected function loadExternalType() {
parent::loadExternalType();
$this->externalModelClassName = TaskModel::class;
$this->externalTableName = "process_task";
$this->aliasTableName = $this->parentFieldName . "_" . $this->externalTableName;
$this->id = new \Nemundo\Model\Type\Id\IdType();
$this->id->fieldName = "id";
$this->id->tableName = $this->parentFieldName . "_" . $this->externalTableName;
$this->id->aliasFieldName = $this->id->tableName . "_" . $this->id->fieldName;
$this->id->label = "Id";
$this->addType($this->id);

$this->sourceId = new \Nemundo\Model\Type\Id\IdType();
$this->sourceId->fieldName = "source";
$this->sourceId->tableName = $this->parentFieldName . "_" . $this->externalTableName;
$this->sourceId->aliasFieldName = $this->sourceId->tableName ."_".$this->sourceId->fieldName;
$this->sourceId->label = "Source";
$this->addType($this->sourceId);

$this->assignmentId = new \Nemundo\Model\Type\Id\IdType();
$this->assignmentId->fieldName = "assignment";
$this->assignmentId->tableName = $this->parentFieldName . "_" . $this->externalTableName;
$this->assignmentId->aliasFieldName = $this->assignmentId->tableName ."_".$this->assignmentId->fieldName;
$this->assignmentId->label = "Assignment";
$this->addType($this->assignmentId);

$this->deadline = new \Nemundo\Model\Type\DateTime\DateType();
$this->deadline->fieldName = "deadline";
$this->deadline->tableName = $this->parentFieldName . "_" . $this->externalTableName;
$this->deadline->aliasFieldName = $this->deadline->tableName . "_" . $this->deadline->fieldName;
$this->deadline->label = "Deadline";
$this->addType($this->deadline);

$this->task = new \Nemundo\Model\Type\Text\TextType();
$this->task->fieldName = "task";
$this->task->tableName = $this->parentFieldName . "_" . $this->externalTableName;
$this->task->aliasFieldName = $this->task->tableName . "_" . $this->task->fieldName;
$this->task->label = "Task";
$this->addType($this->task);

$this->closed = new \Nemundo\Model\Type\Number\YesNoType();
$this->closed->fieldName = "closed";
$this->closed->tableName = $this->parentFieldName . "_" . $this->externalTableName;
$this->closed->aliasFieldName = $this->closed->tableName . "_" . $this->closed->fieldName;
$this->closed->label = "Closed";
$this->addType($this->closed);

}
public function loadSource() {
if ($this->source == null) {
$this->source = new \Nemundo\Process\Content\Data\Content\ContentExternalType(null, $this->parentFieldName . "_source");
$this->source->fieldName = "source";
$this->source->tableName = $this->parentFieldName . "_" . $this->externalTableName;
$this->source->aliasFieldName = $this->source->tableName ."_".$this->source->fieldName;
$this->source->label = "Source";
$this->addType($this->source);
}
return $this;
}
public function loadAssignment() {
if ($this->assignment == null) {
$this->assignment = new \Nemundo\Process\Group\Data\Group\GroupExternalType(null, $this->parentFieldName . "_assignment");
$this->assignment->fieldName = "assignment";
$this->assignment->tableName = $this->parentFieldName . "_" . $this->externalTableName;
$this->assignment->aliasFieldName = $this->assignment->tableName ."_".$this->assignment->fieldName;
$this->assignment->label = "Assignment";
$this->addType($this->assignment);
}
return $this;
}
}