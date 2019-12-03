<?php
namespace Nemundo\Process\Data\Workflow;
class WorkflowModel extends \Nemundo\Model\Definition\Model\AbstractModel {
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
* @var \Nemundo\Model\Type\External\Id\ExternalUniqueIdType
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
* @var \Nemundo\Model\Type\External\Id\ExternalUniqueIdType
*/
public $statusId;

/**
* @var \Nemundo\Process\Data\Status\StatusExternalType
*/
public $status;

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
$this->workflowNumber->label = "Workflow Number";
$this->workflowNumber->allowNullValue = false;
$this->workflowNumber->length = 50;

$this->subject = new \Nemundo\Model\Type\Text\TextType($this);
$this->subject->tableName = "process_workflow";
$this->subject->fieldName = "subject";
$this->subject->aliasFieldName = "process_workflow_subject";
$this->subject->label = "Subject";
$this->subject->allowNullValue = false;
$this->subject->length = 255;

$this->processId = new \Nemundo\Model\Type\External\Id\ExternalUniqueIdType($this);
$this->processId->tableName = "process_workflow";
$this->processId->fieldName = "process";
$this->processId->aliasFieldName = "process_workflow_process";
$this->processId->label = "Process";
$this->processId->allowNullValue = false;

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

}
public function loadProcess() {
if ($this->process == null) {
$this->process = new \Nemundo\Process\Data\Process\ProcessExternalType($this, "process_workflow_process");
$this->process->tableName = "process_workflow";
$this->process->fieldName = "process";
$this->process->aliasFieldName = "process_workflow_process";
$this->process->label = "Process";
}
return $this;
}
public function loadStatus() {
if ($this->status == null) {
$this->status = new \Nemundo\Process\Data\Status\StatusExternalType($this, "process_workflow_status");
$this->status->tableName = "process_workflow";
$this->status->fieldName = "status";
$this->status->aliasFieldName = "process_workflow_status";
$this->status->label = "Status";
}
return $this;
}
}