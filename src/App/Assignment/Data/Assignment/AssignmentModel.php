<?php
namespace Nemundo\Process\App\Assignment\Data\Assignment;
class AssignmentModel extends \Nemundo\Model\Definition\Model\AbstractModel {
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
public $groupId;

/**
* @var \Nemundo\Process\Group\Data\Group\GroupExternalType
*/
public $group;

/**
* @var \Nemundo\Model\Type\Text\LargeTextType
*/
public $message;

/**
* @var \Nemundo\Model\Type\External\Id\ExternalIdType
*/
public $statusId;

/**
* @var \Nemundo\Process\App\Assignment\Data\AssignmentStatus\AssignmentStatusExternalType
*/
public $status;

/**
* @var \Nemundo\Model\Type\DateTime\DateType
*/
public $deadline;

/**
* @var \Nemundo\Model\Type\External\Id\ExternalIdType
*/
public $contentId;

/**
* @var \Nemundo\Process\Content\Data\Content\ContentExternalType
*/
public $content;

protected function loadModel() {
$this->tableName = "process_assignment";
$this->aliasTableName = "process_assignment";
$this->label = "Assignment";

$this->primaryIndex = new \Nemundo\Db\Index\AutoIncrementIdPrimaryIndex();

$this->id = new \Nemundo\Model\Type\Id\IdType($this);
$this->id->tableName = "process_assignment";
$this->id->fieldName = "id";
$this->id->aliasFieldName = "process_assignment_id";
$this->id->label = "Id";
$this->id->allowNullValue = false;
$this->id->visible->form = false;
$this->id->visible->table = false;
$this->id->visible->view = false;
$this->id->visible->form = false;

$this->sourceId = new \Nemundo\Model\Type\External\Id\ExternalIdType($this);
$this->sourceId->tableName = "process_assignment";
$this->sourceId->fieldName = "source";
$this->sourceId->aliasFieldName = "process_assignment_source";
$this->sourceId->label = "Source";
$this->sourceId->allowNullValue = false;

$this->groupId = new \Nemundo\Model\Type\External\Id\ExternalUniqueIdType($this);
$this->groupId->tableName = "process_assignment";
$this->groupId->fieldName = "group";
$this->groupId->aliasFieldName = "process_assignment_group";
$this->groupId->label = "Group";
$this->groupId->allowNullValue = false;

$this->message = new \Nemundo\Model\Type\Text\LargeTextType($this);
$this->message->tableName = "process_assignment";
$this->message->fieldName = "message";
$this->message->aliasFieldName = "process_assignment_message";
$this->message->label = "Message";
$this->message->allowNullValue = false;

$this->statusId = new \Nemundo\Model\Type\External\Id\ExternalIdType($this);
$this->statusId->tableName = "process_assignment";
$this->statusId->fieldName = "status";
$this->statusId->aliasFieldName = "process_assignment_status";
$this->statusId->label = "Status";
$this->statusId->allowNullValue = false;

$this->deadline = new \Nemundo\Model\Type\DateTime\DateType($this);
$this->deadline->tableName = "process_assignment";
$this->deadline->fieldName = "deadline";
$this->deadline->aliasFieldName = "process_assignment_deadline";
$this->deadline->label = "Deadline";
$this->deadline->allowNullValue = false;

$this->contentId = new \Nemundo\Model\Type\External\Id\ExternalIdType($this);
$this->contentId->tableName = "process_assignment";
$this->contentId->fieldName = "content";
$this->contentId->aliasFieldName = "process_assignment_content";
$this->contentId->label = "Content";
$this->contentId->allowNullValue = false;

$index = new \Nemundo\Model\Definition\Index\ModelIndex($this);
$index->indexName = "source";
$index->addType($this->sourceId);

$index = new \Nemundo\Model\Definition\Index\ModelIndex($this);
$index->indexName = "status";
$index->addType($this->statusId);

}
public function loadSource() {
if ($this->source == null) {
$this->source = new \Nemundo\Process\Content\Data\Content\ContentExternalType($this, "process_assignment_source");
$this->source->tableName = "process_assignment";
$this->source->fieldName = "source";
$this->source->aliasFieldName = "process_assignment_source";
$this->source->label = "Source";
}
return $this;
}
public function loadGroup() {
if ($this->group == null) {
$this->group = new \Nemundo\Process\Group\Data\Group\GroupExternalType($this, "process_assignment_group");
$this->group->tableName = "process_assignment";
$this->group->fieldName = "group";
$this->group->aliasFieldName = "process_assignment_group";
$this->group->label = "Group";
}
return $this;
}
public function loadStatus() {
if ($this->status == null) {
$this->status = new \Nemundo\Process\App\Assignment\Data\AssignmentStatus\AssignmentStatusExternalType($this, "process_assignment_status");
$this->status->tableName = "process_assignment";
$this->status->fieldName = "status";
$this->status->aliasFieldName = "process_assignment_status";
$this->status->label = "Status";
}
return $this;
}
public function loadContent() {
if ($this->content == null) {
$this->content = new \Nemundo\Process\Content\Data\Content\ContentExternalType($this, "process_assignment_content");
$this->content->tableName = "process_assignment";
$this->content->fieldName = "content";
$this->content->aliasFieldName = "process_assignment_content";
$this->content->label = "Content";
}
return $this;
}
}