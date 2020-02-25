<?php
namespace Nemundo\Process\App\Assignment\Data\AssignmentIndex;
class AssignmentIndexModel extends \Nemundo\Model\Definition\Model\AbstractModel {
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
* @var \Nemundo\Model\Type\Text\TextType
*/
public $subject;

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
* @var \Nemundo\Model\Type\Number\YesNoType
*/
public $closed;

/**
* @var \Nemundo\Model\Type\External\Id\ExternalIdType
*/
public $contentId;

/**
* @var \Nemundo\Process\Content\Data\Content\ContentExternalType
*/
public $content;

protected function loadModel() {
$this->tableName = "assignment_assignment_index";
$this->aliasTableName = "assignment_assignment_index";
$this->label = "Assignment Index";

$this->primaryIndex = new \Nemundo\Db\Index\AutoIncrementIdPrimaryIndex();

$this->id = new \Nemundo\Model\Type\Id\IdType($this);
$this->id->tableName = "assignment_assignment_index";
$this->id->fieldName = "id";
$this->id->aliasFieldName = "assignment_assignment_index_id";
$this->id->label = "Id";
$this->id->allowNullValue = false;
$this->id->visible->form = false;
$this->id->visible->table = false;
$this->id->visible->view = false;
$this->id->visible->form = false;

$this->sourceId = new \Nemundo\Model\Type\External\Id\ExternalIdType($this);
$this->sourceId->tableName = "assignment_assignment_index";
$this->sourceId->fieldName = "source";
$this->sourceId->aliasFieldName = "assignment_assignment_index_source";
$this->sourceId->label = "Source";
$this->sourceId->allowNullValue = false;

$this->subject = new \Nemundo\Model\Type\Text\TextType($this);
$this->subject->tableName = "assignment_assignment_index";
$this->subject->fieldName = "subject";
$this->subject->aliasFieldName = "assignment_assignment_index_subject";
$this->subject->label = "Subject";
$this->subject->allowNullValue = false;
$this->subject->length = 255;

$this->assignmentId = new \Nemundo\Model\Type\External\Id\ExternalUniqueIdType($this);
$this->assignmentId->tableName = "assignment_assignment_index";
$this->assignmentId->fieldName = "assignment";
$this->assignmentId->aliasFieldName = "assignment_assignment_index_assignment";
$this->assignmentId->label = "Assignment";
$this->assignmentId->allowNullValue = false;

$this->deadline = new \Nemundo\Model\Type\DateTime\DateType($this);
$this->deadline->tableName = "assignment_assignment_index";
$this->deadline->fieldName = "deadline";
$this->deadline->aliasFieldName = "assignment_assignment_index_deadline";
$this->deadline->label = "Deadline";
$this->deadline->allowNullValue = false;

$this->closed = new \Nemundo\Model\Type\Number\YesNoType($this);
$this->closed->tableName = "assignment_assignment_index";
$this->closed->fieldName = "closed";
$this->closed->aliasFieldName = "assignment_assignment_index_closed";
$this->closed->label = "Closed";
$this->closed->allowNullValue = false;

$this->contentId = new \Nemundo\Model\Type\External\Id\ExternalIdType($this);
$this->contentId->tableName = "assignment_assignment_index";
$this->contentId->fieldName = "content";
$this->contentId->aliasFieldName = "assignment_assignment_index_content";
$this->contentId->label = "Task";
$this->contentId->allowNullValue = false;

}
public function loadSource() {
if ($this->source == null) {
$this->source = new \Nemundo\Process\Content\Data\Content\ContentExternalType($this, "assignment_assignment_index_source");
$this->source->tableName = "assignment_assignment_index";
$this->source->fieldName = "source";
$this->source->aliasFieldName = "assignment_assignment_index_source";
$this->source->label = "Source";
}
return $this;
}
public function loadAssignment() {
if ($this->assignment == null) {
$this->assignment = new \Nemundo\Process\Group\Data\Group\GroupExternalType($this, "assignment_assignment_index_assignment");
$this->assignment->tableName = "assignment_assignment_index";
$this->assignment->fieldName = "assignment";
$this->assignment->aliasFieldName = "assignment_assignment_index_assignment";
$this->assignment->label = "Assignment";
}
return $this;
}
public function loadContent() {
if ($this->content == null) {
$this->content = new \Nemundo\Process\Content\Data\Content\ContentExternalType($this, "assignment_assignment_index_content");
$this->content->tableName = "assignment_assignment_index";
$this->content->fieldName = "content";
$this->content->aliasFieldName = "assignment_assignment_index_content";
$this->content->label = "Task";
}
return $this;
}
}