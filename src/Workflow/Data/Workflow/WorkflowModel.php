<?php
namespace Nemundo\Process\Workflow\Data\Workflow;
class WorkflowModel extends \Nemundo\Model\Template\AbstractActiveModel {
/**
* @var \Nemundo\Model\Type\Id\IdType
*/
public $id;

/**
* @var \Nemundo\Model\Type\Number\NumberType
*/
public $number;

/**
* @var \Nemundo\Model\Type\Text\TextType
*/
public $workflowNumber;

/**
* @var \Nemundo\Model\Type\Text\TextType
*/
public $subject;

/**
* @var \Nemundo\Model\Type\Number\YesNoType
*/
public $workflowClosed;

/**
* @var \Nemundo\Model\Type\External\Id\ExternalUniqueIdType
*/
public $statusId;

/**
* @var \Nemundo\Process\Content\Data\ContentType\ContentTypeExternalType
*/
public $status;

/**
* @var \Nemundo\Model\Type\DateTime\DateType
*/
public $deadline;

/**
* @var \Nemundo\Model\Type\External\Id\ExternalUniqueIdType
*/
public $assignmentId;

/**
* @var \Nemundo\Process\Group\Data\Group\GroupExternalType
*/
public $assignment;

/**
* @var \Nemundo\Model\Type\External\Id\ExternalIdType
*/
public $contentId;

/**
* @var \Nemundo\Process\Content\Data\Content\ContentExternalType
*/
public $content;

protected function loadModel() {
$this->tableName = "process_workflow";
$this->aliasTableName = "process_workflow";
$this->label = "Workflow";

$this->primaryIndex = new \Nemundo\Db\Index\AutoIncrementIdPrimaryIndex();

$this->id = new \Nemundo\Model\Type\Id\IdType($this);
$this->id->tableName = "process_workflow";
$this->id->fieldName = "id";
$this->id->aliasFieldName = "process_workflow_id";
$this->id->label = "Id";
$this->id->allowNullValue = false;
$this->id->visible->form = false;
$this->id->visible->table = false;
$this->id->visible->view = false;
$this->id->visible->form = false;


$this->number = new \Nemundo\Model\Type\Number\NumberType($this);
$this->number->tableName = "process_workflow";
$this->number->fieldName = "number";
$this->number->aliasFieldName = "process_workflow_number";
$this->number->label = "Number";
$this->number->allowNullValue = false;

$this->workflowNumber = new \Nemundo\Model\Type\Text\TextType($this);
$this->workflowNumber->tableName = "process_workflow";
$this->workflowNumber->fieldName = "workflow_number";
$this->workflowNumber->aliasFieldName = "process_workflow_workflow_number";
$this->workflowNumber->label = "Nr.";
$this->workflowNumber->allowNullValue = false;
$this->workflowNumber->length = 50;

$this->subject = new \Nemundo\Model\Type\Text\TextType($this);
$this->subject->tableName = "process_workflow";
$this->subject->fieldName = "subject";
$this->subject->aliasFieldName = "process_workflow_subject";
$this->subject->label = "Betreff";
$this->subject->allowNullValue = false;
$this->subject->length = 255;

$this->workflowClosed = new \Nemundo\Model\Type\Number\YesNoType($this);
$this->workflowClosed->tableName = "process_workflow";
$this->workflowClosed->fieldName = "workflow_closed";
$this->workflowClosed->aliasFieldName = "process_workflow_workflow_closed";
$this->workflowClosed->label = "Workflow Closed";
$this->workflowClosed->allowNullValue = false;

$this->statusId = new \Nemundo\Model\Type\External\Id\ExternalUniqueIdType($this);
$this->statusId->tableName = "process_workflow";
$this->statusId->fieldName = "status";
$this->statusId->aliasFieldName = "process_workflow_status";
$this->statusId->label = "Status";
$this->statusId->allowNullValue = false;

$this->deadline = new \Nemundo\Model\Type\DateTime\DateType($this);
$this->deadline->tableName = "process_workflow";
$this->deadline->fieldName = "deadline";
$this->deadline->aliasFieldName = "process_workflow_deadline";
$this->deadline->label = "Deadline";
$this->deadline->allowNullValue = false;

$this->assignmentId = new \Nemundo\Model\Type\External\Id\ExternalUniqueIdType($this);
$this->assignmentId->tableName = "process_workflow";
$this->assignmentId->fieldName = "assignment";
$this->assignmentId->aliasFieldName = "process_workflow_assignment";
$this->assignmentId->label = "Zuweisung";
$this->assignmentId->allowNullValue = false;

$this->contentId = new \Nemundo\Model\Type\External\Id\ExternalIdType($this);
$this->contentId->tableName = "process_workflow";
$this->contentId->fieldName = "content";
$this->contentId->aliasFieldName = "process_workflow_content";
$this->contentId->label = "Content";
$this->contentId->allowNullValue = false;

$index = new \Nemundo\Model\Definition\Index\ModelIndex($this);
$index->indexName = "content";
$index->addType($this->contentId);

$index = new \Nemundo\Model\Definition\Index\ModelIndex($this);
$index->indexName = "content_number";
$index->addType($this->contentId);
$index->addType($this->number);

}
public function loadStatus() {
if ($this->status == null) {
$this->status = new \Nemundo\Process\Content\Data\ContentType\ContentTypeExternalType($this, "process_workflow_status");
$this->status->tableName = "process_workflow";
$this->status->fieldName = "status";
$this->status->aliasFieldName = "process_workflow_status";
$this->status->label = "Status";
}
return $this;
}
public function loadAssignment() {
if ($this->assignment == null) {
$this->assignment = new \Nemundo\Process\Group\Data\Group\GroupExternalType($this, "process_workflow_assignment");
$this->assignment->tableName = "process_workflow";
$this->assignment->fieldName = "assignment";
$this->assignment->aliasFieldName = "process_workflow_assignment";
$this->assignment->label = "Zuweisung";
}
return $this;
}
public function loadContent() {
if ($this->content == null) {
$this->content = new \Nemundo\Process\Content\Data\Content\ContentExternalType($this, "process_workflow_content");
$this->content->tableName = "process_workflow";
$this->content->fieldName = "content";
$this->content->aliasFieldName = "process_workflow_content";
$this->content->label = "Content";
}
return $this;
}
}