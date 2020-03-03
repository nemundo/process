<?php
namespace Nemundo\Process\App\Task\Data\Task;
class TaskModel extends \Nemundo\Model\Definition\Model\AbstractModel {
/**
* @var \Nemundo\Model\Type\Id\IdType
*/
public $id;

/**
* @var \Nemundo\Model\Type\External\Id\ExternalIdType
*/
public $sourceId;

/**
* @var \Nemundo\Process\Content\Data\Content\ContentExternalType
*/
public $source;

/**
* @var \Nemundo\Model\Type\External\Id\ExternalUniqueIdType
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

protected function loadModel() {
$this->tableName = "process_task";
$this->aliasTableName = "process_task";
$this->label = "Task";

$this->primaryIndex = new \Nemundo\Db\Index\AutoIncrementIdPrimaryIndex();

$this->id = new \Nemundo\Model\Type\Id\IdType($this);
$this->id->tableName = "process_task";
$this->id->fieldName = "id";
$this->id->aliasFieldName = "process_task_id";
$this->id->label = "Id";
$this->id->allowNullValue = false;
$this->id->visible->form = false;
$this->id->visible->table = false;
$this->id->visible->view = false;
$this->id->visible->form = false;

$this->sourceId = new \Nemundo\Model\Type\External\Id\ExternalIdType($this);
$this->sourceId->tableName = "process_task";
$this->sourceId->fieldName = "source";
$this->sourceId->aliasFieldName = "process_task_source";
$this->sourceId->label = "Source";
$this->sourceId->allowNullValue = false;

$this->assignmentId = new \Nemundo\Model\Type\External\Id\ExternalUniqueIdType($this);
$this->assignmentId->tableName = "process_task";
$this->assignmentId->fieldName = "assignment";
$this->assignmentId->aliasFieldName = "process_task_assignment";
$this->assignmentId->label = "Assignment";
$this->assignmentId->allowNullValue = false;

$this->deadline = new \Nemundo\Model\Type\DateTime\DateType($this);
$this->deadline->tableName = "process_task";
$this->deadline->fieldName = "deadline";
$this->deadline->aliasFieldName = "process_task_deadline";
$this->deadline->label = "Deadline";
$this->deadline->allowNullValue = false;

$this->task = new \Nemundo\Model\Type\Text\TextType($this);
$this->task->tableName = "process_task";
$this->task->fieldName = "task";
$this->task->aliasFieldName = "process_task_task";
$this->task->label = "Task";
$this->task->allowNullValue = false;
$this->task->length = 255;

$this->closed = new \Nemundo\Model\Type\Number\YesNoType($this);
$this->closed->tableName = "process_task";
$this->closed->fieldName = "closed";
$this->closed->aliasFieldName = "process_task_closed";
$this->closed->label = "Closed";
$this->closed->allowNullValue = false;

}
public function loadSource() {
if ($this->source == null) {
$this->source = new \Nemundo\Process\Content\Data\Content\ContentExternalType($this, "process_task_source");
$this->source->tableName = "process_task";
$this->source->fieldName = "source";
$this->source->aliasFieldName = "process_task_source";
$this->source->label = "Source";
}
return $this;
}
public function loadAssignment() {
if ($this->assignment == null) {
$this->assignment = new \Nemundo\Process\Group\Data\Group\GroupExternalType($this, "process_task_assignment");
$this->assignment->tableName = "process_task";
$this->assignment->fieldName = "assignment";
$this->assignment->aliasFieldName = "process_task_assignment";
$this->assignment->label = "Assignment";
}
return $this;
}
}