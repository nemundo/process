<?php
namespace Nemundo\Process\App\Task\Data\TaskIndex;
class TaskIndexModel extends \Nemundo\Model\Definition\Model\AbstractModel {
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
* @var \Nemundo\Model\Type\External\Id\ExternalIdType
*/
public $contentId;

/**
* @var \Nemundo\Process\Content\Data\Content\ContentExternalType
*/
public $content;

/**
* @var \Nemundo\Model\Type\Text\TextType
*/
public $subject;

/**
* @var \Nemundo\Model\Type\External\Id\ExternalIdType
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
* @var \Nemundo\Model\Type\External\Id\ExternalUniqueIdType
*/
public $userId;

/**
* @var \Nemundo\User\Data\User\UserExternalType
*/
public $user;

/**
* @var \Nemundo\Model\Type\DateTime\DateTimeType
*/
public $dateTime;

/**
* @var \Nemundo\Model\Type\Number\YesNoType
*/
public $closed;

/**
* @var \Nemundo\Model\Type\External\Id\ExternalUniqueIdType
*/
public $taskTypeId;

/**
* @var \Nemundo\Process\Content\Data\ContentType\ContentTypeExternalType
*/
public $taskType;

/**
* @var \Nemundo\Model\Type\Number\YesNoType
*/
public $updateStatus;

/**
* @var \Nemundo\Model\Type\Number\YesNoType
*/
public $hasSource;

protected function loadModel() {
$this->tableName = "process_task_index";
$this->aliasTableName = "process_task_index";
$this->label = "Task Index";

$this->primaryIndex = new \Nemundo\Db\Index\AutoIncrementIdPrimaryIndex();

$this->id = new \Nemundo\Model\Type\Id\IdType($this);
$this->id->tableName = "process_task_index";
$this->id->fieldName = "id";
$this->id->aliasFieldName = "process_task_index_id";
$this->id->label = "Id";
$this->id->allowNullValue = false;
$this->id->visible->form = false;
$this->id->visible->table = false;
$this->id->visible->view = false;
$this->id->visible->form = false;

$this->sourceId = new \Nemundo\Model\Type\External\Id\ExternalIdType($this);
$this->sourceId->tableName = "process_task_index";
$this->sourceId->fieldName = "source";
$this->sourceId->aliasFieldName = "process_task_index_source";
$this->sourceId->label = "Source";
$this->sourceId->allowNullValue = false;

$this->contentId = new \Nemundo\Model\Type\External\Id\ExternalIdType($this);
$this->contentId->tableName = "process_task_index";
$this->contentId->fieldName = "content";
$this->contentId->aliasFieldName = "process_task_index_content";
$this->contentId->label = "Content";
$this->contentId->allowNullValue = false;

$this->subject = new \Nemundo\Model\Type\Text\TextType($this);
$this->subject->tableName = "process_task_index";
$this->subject->fieldName = "subject";
$this->subject->aliasFieldName = "process_task_index_subject";
$this->subject->label = "Aufgabe";
$this->subject->allowNullValue = false;
$this->subject->length = 255;

$this->assignmentId = new \Nemundo\Model\Type\External\Id\ExternalIdType($this);
$this->assignmentId->tableName = "process_task_index";
$this->assignmentId->fieldName = "assignment";
$this->assignmentId->aliasFieldName = "process_task_index_assignment";
$this->assignmentId->label = "Verantwortlicher";
$this->assignmentId->allowNullValue = false;

$this->deadline = new \Nemundo\Model\Type\DateTime\DateType($this);
$this->deadline->tableName = "process_task_index";
$this->deadline->fieldName = "deadline";
$this->deadline->aliasFieldName = "process_task_index_deadline";
$this->deadline->label = "Erledigen bis";
$this->deadline->allowNullValue = false;

$this->userId = new \Nemundo\Model\Type\External\Id\ExternalUniqueIdType($this);
$this->userId->tableName = "process_task_index";
$this->userId->fieldName = "user";
$this->userId->aliasFieldName = "process_task_index_user";
$this->userId->label = "Ersteller";
$this->userId->allowNullValue = false;

$this->dateTime = new \Nemundo\Model\Type\DateTime\DateTimeType($this);
$this->dateTime->tableName = "process_task_index";
$this->dateTime->fieldName = "date_time";
$this->dateTime->aliasFieldName = "process_task_index_date_time";
$this->dateTime->label = "Date Time";
$this->dateTime->allowNullValue = false;

$this->closed = new \Nemundo\Model\Type\Number\YesNoType($this);
$this->closed->tableName = "process_task_index";
$this->closed->fieldName = "closed";
$this->closed->aliasFieldName = "process_task_index_closed";
$this->closed->label = "Closed";
$this->closed->allowNullValue = false;

$this->taskTypeId = new \Nemundo\Model\Type\External\Id\ExternalUniqueIdType($this);
$this->taskTypeId->tableName = "process_task_index";
$this->taskTypeId->fieldName = "task_type";
$this->taskTypeId->aliasFieldName = "process_task_index_task_type";
$this->taskTypeId->label = "Task Type";
$this->taskTypeId->allowNullValue = false;

$this->updateStatus = new \Nemundo\Model\Type\Number\YesNoType($this);
$this->updateStatus->tableName = "process_task_index";
$this->updateStatus->fieldName = "update_status";
$this->updateStatus->aliasFieldName = "process_task_index_update_status";
$this->updateStatus->label = "Update Status";
$this->updateStatus->allowNullValue = false;

$this->hasSource = new \Nemundo\Model\Type\Number\YesNoType($this);
$this->hasSource->tableName = "process_task_index";
$this->hasSource->fieldName = "has_source";
$this->hasSource->aliasFieldName = "process_task_index_has_source";
$this->hasSource->label = "Has Source";
$this->hasSource->allowNullValue = false;

$index = new \Nemundo\Model\Definition\Index\ModelUniqueIndex($this);
$index->indexName = "source_content";
$index->addType($this->sourceId);
$index->addType($this->contentId);

$index = new \Nemundo\Model\Definition\Index\ModelIndex($this);
$index->indexName = "content";
$index->addType($this->contentId);

}
public function loadSource() {
if ($this->source == null) {
$this->source = new \Nemundo\Process\Content\Data\Content\ContentExternalType($this, "process_task_index_source");
$this->source->tableName = "process_task_index";
$this->source->fieldName = "source";
$this->source->aliasFieldName = "process_task_index_source";
$this->source->label = "Source";
}
return $this;
}
public function loadContent() {
if ($this->content == null) {
$this->content = new \Nemundo\Process\Content\Data\Content\ContentExternalType($this, "process_task_index_content");
$this->content->tableName = "process_task_index";
$this->content->fieldName = "content";
$this->content->aliasFieldName = "process_task_index_content";
$this->content->label = "Content";
}
return $this;
}
public function loadAssignment() {
if ($this->assignment == null) {
$this->assignment = new \Nemundo\Process\Group\Data\Group\GroupExternalType($this, "process_task_index_assignment");
$this->assignment->tableName = "process_task_index";
$this->assignment->fieldName = "assignment";
$this->assignment->aliasFieldName = "process_task_index_assignment";
$this->assignment->label = "Verantwortlicher";
}
return $this;
}
public function loadUser() {
if ($this->user == null) {
$this->user = new \Nemundo\User\Data\User\UserExternalType($this, "process_task_index_user");
$this->user->tableName = "process_task_index";
$this->user->fieldName = "user";
$this->user->aliasFieldName = "process_task_index_user";
$this->user->label = "Ersteller";
}
return $this;
}
public function loadTaskType() {
if ($this->taskType == null) {
$this->taskType = new \Nemundo\Process\Content\Data\ContentType\ContentTypeExternalType($this, "process_task_index_task_type");
$this->taskType->tableName = "process_task_index";
$this->taskType->fieldName = "task_type";
$this->taskType->aliasFieldName = "process_task_index_task_type";
$this->taskType->label = "Task Type";
}
return $this;
}
}