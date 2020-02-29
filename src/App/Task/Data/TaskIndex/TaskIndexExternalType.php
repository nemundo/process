<?php
namespace Nemundo\Process\App\Task\Data\TaskIndex;
class TaskIndexExternalType extends \Nemundo\Model\Type\External\ExternalType {
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
* @var \Nemundo\Model\Type\Id\IdType
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
public $updateStatus;

protected function loadExternalType() {
parent::loadExternalType();
$this->externalModelClassName = TaskIndexModel::class;
$this->externalTableName = "process_task_index";
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

$this->contentId = new \Nemundo\Model\Type\Id\IdType();
$this->contentId->fieldName = "content";
$this->contentId->tableName = $this->parentFieldName . "_" . $this->externalTableName;
$this->contentId->aliasFieldName = $this->contentId->tableName ."_".$this->contentId->fieldName;
$this->contentId->label = "Content";
$this->addType($this->contentId);

$this->subject = new \Nemundo\Model\Type\Text\TextType();
$this->subject->fieldName = "subject";
$this->subject->tableName = $this->parentFieldName . "_" . $this->externalTableName;
$this->subject->aliasFieldName = $this->subject->tableName . "_" . $this->subject->fieldName;
$this->subject->label = "Aufgabe";
$this->addType($this->subject);

$this->assignmentId = new \Nemundo\Model\Type\Id\IdType();
$this->assignmentId->fieldName = "assignment";
$this->assignmentId->tableName = $this->parentFieldName . "_" . $this->externalTableName;
$this->assignmentId->aliasFieldName = $this->assignmentId->tableName ."_".$this->assignmentId->fieldName;
$this->assignmentId->label = "Verantwortlicher";
$this->addType($this->assignmentId);

$this->deadline = new \Nemundo\Model\Type\DateTime\DateType();
$this->deadline->fieldName = "deadline";
$this->deadline->tableName = $this->parentFieldName . "_" . $this->externalTableName;
$this->deadline->aliasFieldName = $this->deadline->tableName . "_" . $this->deadline->fieldName;
$this->deadline->label = "Erledigen bis";
$this->addType($this->deadline);

$this->userId = new \Nemundo\Model\Type\Id\IdType();
$this->userId->fieldName = "user";
$this->userId->tableName = $this->parentFieldName . "_" . $this->externalTableName;
$this->userId->aliasFieldName = $this->userId->tableName ."_".$this->userId->fieldName;
$this->userId->label = "Ersteller";
$this->addType($this->userId);

$this->dateTime = new \Nemundo\Model\Type\DateTime\DateTimeType();
$this->dateTime->fieldName = "date_time";
$this->dateTime->tableName = $this->parentFieldName . "_" . $this->externalTableName;
$this->dateTime->aliasFieldName = $this->dateTime->tableName . "_" . $this->dateTime->fieldName;
$this->dateTime->label = "Date Time";
$this->addType($this->dateTime);

$this->closed = new \Nemundo\Model\Type\Number\YesNoType();
$this->closed->fieldName = "closed";
$this->closed->tableName = $this->parentFieldName . "_" . $this->externalTableName;
$this->closed->aliasFieldName = $this->closed->tableName . "_" . $this->closed->fieldName;
$this->closed->label = "Closed";
$this->addType($this->closed);

$this->taskTypeId = new \Nemundo\Model\Type\Id\IdType();
$this->taskTypeId->fieldName = "task_type";
$this->taskTypeId->tableName = $this->parentFieldName . "_" . $this->externalTableName;
$this->taskTypeId->aliasFieldName = $this->taskTypeId->tableName ."_".$this->taskTypeId->fieldName;
$this->taskTypeId->label = "Task Type";
$this->addType($this->taskTypeId);

$this->updateStatus = new \Nemundo\Model\Type\Number\YesNoType();
$this->updateStatus->fieldName = "update_status";
$this->updateStatus->tableName = $this->parentFieldName . "_" . $this->externalTableName;
$this->updateStatus->aliasFieldName = $this->updateStatus->tableName . "_" . $this->updateStatus->fieldName;
$this->updateStatus->label = "Update Status";
$this->addType($this->updateStatus);

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
public function loadContent() {
if ($this->content == null) {
$this->content = new \Nemundo\Process\Content\Data\Content\ContentExternalType(null, $this->parentFieldName . "_content");
$this->content->fieldName = "content";
$this->content->tableName = $this->parentFieldName . "_" . $this->externalTableName;
$this->content->aliasFieldName = $this->content->tableName ."_".$this->content->fieldName;
$this->content->label = "Content";
$this->addType($this->content);
}
return $this;
}
public function loadAssignment() {
if ($this->assignment == null) {
$this->assignment = new \Nemundo\Process\Group\Data\Group\GroupExternalType(null, $this->parentFieldName . "_assignment");
$this->assignment->fieldName = "assignment";
$this->assignment->tableName = $this->parentFieldName . "_" . $this->externalTableName;
$this->assignment->aliasFieldName = $this->assignment->tableName ."_".$this->assignment->fieldName;
$this->assignment->label = "Verantwortlicher";
$this->addType($this->assignment);
}
return $this;
}
public function loadUser() {
if ($this->user == null) {
$this->user = new \Nemundo\User\Data\User\UserExternalType(null, $this->parentFieldName . "_user");
$this->user->fieldName = "user";
$this->user->tableName = $this->parentFieldName . "_" . $this->externalTableName;
$this->user->aliasFieldName = $this->user->tableName ."_".$this->user->fieldName;
$this->user->label = "Ersteller";
$this->addType($this->user);
}
return $this;
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