<?php
namespace Nemundo\Process\Data\Workflow;
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
* @var \Nemundo\Model\Type\Id\IdType
*/
public $processId;

/**
* @var \Nemundo\Process\Data\Process\ProcessExternalType
*/
public $process;

/**
* @var \Nemundo\Model\Type\Number\YesNoType
*/
public $workflowClosed;

/**
* @var \Nemundo\Model\Type\Id\IdType
*/
public $statusId;

/**
* @var \Nemundo\Process\Data\Status\StatusExternalType
*/
public $status;

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
$this->workflowNumber->label = "Workflow Number";
$this->addType($this->workflowNumber);

$this->subject = new \Nemundo\Model\Type\Text\TextType();
$this->subject->fieldName = "subject";
$this->subject->tableName = $this->parentFieldName . "_" . $this->externalTableName;
$this->subject->aliasFieldName = $this->subject->tableName . "_" . $this->subject->fieldName;
$this->subject->label = "Subject";
$this->addType($this->subject);

$this->processId = new \Nemundo\Model\Type\Id\IdType();
$this->processId->fieldName = "process";
$this->processId->tableName = $this->parentFieldName . "_" . $this->externalTableName;
$this->processId->aliasFieldName = $this->processId->tableName ."_".$this->processId->fieldName;
$this->processId->label = "Process";
$this->addType($this->processId);

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

}
public function loadProcess() {
if ($this->process == null) {
$this->process = new \Nemundo\Process\Data\Process\ProcessExternalType(null, $this->parentFieldName . "_process");
$this->process->fieldName = "process";
$this->process->tableName = $this->parentFieldName . "_" . $this->externalTableName;
$this->process->aliasFieldName = $this->process->tableName ."_".$this->process->fieldName;
$this->process->label = "Process";
$this->addType($this->process);
}
return $this;
}
public function loadStatus() {
if ($this->status == null) {
$this->status = new \Nemundo\Process\Data\Status\StatusExternalType(null, $this->parentFieldName . "_status");
$this->status->fieldName = "status";
$this->status->tableName = $this->parentFieldName . "_" . $this->externalTableName;
$this->status->aliasFieldName = $this->status->tableName ."_".$this->status->fieldName;
$this->status->label = "Status";
$this->addType($this->status);
}
return $this;
}
}