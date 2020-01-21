<?php
namespace Nemundo\Process\Workflow\Data\Workflow;
class WorkflowExternalType extends \Nemundo\Model\Type\External\ExternalType {
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
* @var \Nemundo\Model\Type\Id\IdType
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
* @var \Nemundo\Model\Type\Id\IdType
*/
public $assignmentId;

/**
* @var \Nemundo\Process\Group\Data\Group\GroupExternalType
*/
public $assignment;

/**
* @var \Nemundo\Model\Type\Id\IdType
*/
public $contentId;

/**
* @var \Nemundo\Process\Content\Data\Content\ContentExternalType
*/
public $content;

protected function loadExternalType() {
parent::loadExternalType();
$this->externalModelClassName = WorkflowModel::class;
$this->externalTableName = "process_workflow";
$this->aliasTableName = $this->parentFieldName . "_" . $this->externalTableName;
$this->id = new \Nemundo\Model\Type\Id\IdType();
$this->id->fieldName = "id";
$this->id->tableName = $this->parentFieldName . "_" . $this->externalTableName;
$this->id->aliasFieldName = $this->id->tableName . "_" . $this->id->fieldName;
$this->id->label = "Id";
$this->addType($this->id);

$this->number = new \Nemundo\Model\Type\Number\NumberType();
$this->number->fieldName = "number";
$this->number->tableName = $this->parentFieldName . "_" . $this->externalTableName;
$this->number->aliasFieldName = $this->number->tableName . "_" . $this->number->fieldName;
$this->number->label = "Number";
$this->addType($this->number);

$this->workflowNumber = new \Nemundo\Model\Type\Text\TextType();
$this->workflowNumber->fieldName = "workflow_number";
$this->workflowNumber->tableName = $this->parentFieldName . "_" . $this->externalTableName;
$this->workflowNumber->aliasFieldName = $this->workflowNumber->tableName . "_" . $this->workflowNumber->fieldName;
$this->workflowNumber->label = "Nr.";
$this->addType($this->workflowNumber);

$this->subject = new \Nemundo\Model\Type\Text\TextType();
$this->subject->fieldName = "subject";
$this->subject->tableName = $this->parentFieldName . "_" . $this->externalTableName;
$this->subject->aliasFieldName = $this->subject->tableName . "_" . $this->subject->fieldName;
$this->subject->label = "Betreff";
$this->addType($this->subject);

$this->workflowClosed = new \Nemundo\Model\Type\Number\YesNoType();
$this->workflowClosed->fieldName = "workflow_closed";
$this->workflowClosed->tableName = $this->parentFieldName . "_" . $this->externalTableName;
$this->workflowClosed->aliasFieldName = $this->workflowClosed->tableName . "_" . $this->workflowClosed->fieldName;
$this->workflowClosed->label = "Workflow Closed";
$this->addType($this->workflowClosed);

$this->statusId = new \Nemundo\Model\Type\Id\IdType();
$this->statusId->fieldName = "status";
$this->statusId->tableName = $this->parentFieldName . "_" . $this->externalTableName;
$this->statusId->aliasFieldName = $this->statusId->tableName ."_".$this->statusId->fieldName;
$this->statusId->label = "Status";
$this->addType($this->statusId);

$this->deadline = new \Nemundo\Model\Type\DateTime\DateType();
$this->deadline->fieldName = "deadline";
$this->deadline->tableName = $this->parentFieldName . "_" . $this->externalTableName;
$this->deadline->aliasFieldName = $this->deadline->tableName . "_" . $this->deadline->fieldName;
$this->deadline->label = "Deadline";
$this->addType($this->deadline);

$this->assignmentId = new \Nemundo\Model\Type\Id\IdType();
$this->assignmentId->fieldName = "assignment";
$this->assignmentId->tableName = $this->parentFieldName . "_" . $this->externalTableName;
$this->assignmentId->aliasFieldName = $this->assignmentId->tableName ."_".$this->assignmentId->fieldName;
$this->assignmentId->label = "Zuweisung";
$this->addType($this->assignmentId);

$this->contentId = new \Nemundo\Model\Type\Id\IdType();
$this->contentId->fieldName = "content";
$this->contentId->tableName = $this->parentFieldName . "_" . $this->externalTableName;
$this->contentId->aliasFieldName = $this->contentId->tableName ."_".$this->contentId->fieldName;
$this->contentId->label = "Content";
$this->addType($this->contentId);

}
public function loadStatus() {
if ($this->status == null) {
$this->status = new \Nemundo\Process\Content\Data\ContentType\ContentTypeExternalType(null, $this->parentFieldName . "_status");
$this->status->fieldName = "status";
$this->status->tableName = $this->parentFieldName . "_" . $this->externalTableName;
$this->status->aliasFieldName = $this->status->tableName ."_".$this->status->fieldName;
$this->status->label = "Status";
$this->addType($this->status);
}
return $this;
}
public function loadAssignment() {
if ($this->assignment == null) {
$this->assignment = new \Nemundo\Process\Group\Data\Group\GroupExternalType(null, $this->parentFieldName . "_assignment");
$this->assignment->fieldName = "assignment";
$this->assignment->tableName = $this->parentFieldName . "_" . $this->externalTableName;
$this->assignment->aliasFieldName = $this->assignment->tableName ."_".$this->assignment->fieldName;
$this->assignment->label = "Zuweisung";
$this->addType($this->assignment);
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
}