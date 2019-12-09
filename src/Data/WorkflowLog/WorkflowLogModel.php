<?php
namespace Nemundo\Process\Data\WorkflowLog;
class WorkflowLogModel extends \Nemundo\Model\Definition\Model\AbstractModel {
/**
* @var \Nemundo\Model\Type\Id\IdType
*/
public $id;

/**
* @var \Nemundo\Model\Type\External\Id\ExternalUniqueIdType
*/
public $statusId;

/**
* @var \Nemundo\Process\Data\Status\StatusExternalType
*/
public $status;

/**
* @var \Nemundo\Model\Type\Text\TextType
*/
public $dataId;

/**
* @var \Nemundo\Model\Type\External\Id\ExternalUniqueIdType
*/
public $workflowId;

/**
* @var \Nemundo\Process\Data\Workflow\WorkflowExternalType
*/
public $workflow;

/**
* @var \Nemundo\Model\Type\DateTime\DateTimeType
*/
public $dateTime;

/**
* @var \Nemundo\Model\Type\External\Id\ExternalUniqueIdType
*/
public $userId;

/**
* @var \Nemundo\User\Data\User\UserExternalType
*/
public $user;

protected function loadModel() {
$this->tableName = "process_workflow_log";
$this->aliasTableName = "process_workflow_log";
$this->label = "Workflow Log";

$this->primaryIndex = new \Nemundo\Db\Index\AutoIncrementIdPrimaryIndex();

$this->id = new \Nemundo\Model\Type\Id\IdType($this);
$this->id->tableName = "process_workflow_log";
$this->id->fieldName = "id";
$this->id->aliasFieldName = "process_workflow_log_id";
$this->id->label = "Id";
$this->id->allowNullValue = false;
$this->id->visible->form = false;
$this->id->visible->table = false;
$this->id->visible->view = false;
$this->id->visible->form = false;

$this->statusId = new \Nemundo\Model\Type\External\Id\ExternalUniqueIdType($this);
$this->statusId->tableName = "process_workflow_log";
$this->statusId->fieldName = "status";
$this->statusId->aliasFieldName = "process_workflow_log_status";
$this->statusId->label = "Status";
$this->statusId->allowNullValue = false;

$this->dataId = new \Nemundo\Model\Type\Text\TextType($this);
$this->dataId->tableName = "process_workflow_log";
$this->dataId->fieldName = "data_id";
$this->dataId->aliasFieldName = "process_workflow_log_data_id";
$this->dataId->label = "Data Id";
$this->dataId->allowNullValue = false;
$this->dataId->length = 36;

$this->workflowId = new \Nemundo\Model\Type\External\Id\ExternalUniqueIdType($this);
$this->workflowId->tableName = "process_workflow_log";
$this->workflowId->fieldName = "workflow";
$this->workflowId->aliasFieldName = "process_workflow_log_workflow";
$this->workflowId->label = "Workflow";
$this->workflowId->allowNullValue = false;

$this->dateTime = new \Nemundo\Model\Type\DateTime\DateTimeType($this);
$this->dateTime->tableName = "process_workflow_log";
$this->dateTime->fieldName = "date_time";
$this->dateTime->aliasFieldName = "process_workflow_log_date_time";
$this->dateTime->label = "Date Time";
$this->dateTime->allowNullValue = false;

$this->userId = new \Nemundo\Model\Type\External\Id\ExternalUniqueIdType($this);
$this->userId->tableName = "process_workflow_log";
$this->userId->fieldName = "user";
$this->userId->aliasFieldName = "process_workflow_log_user";
$this->userId->label = "User";
$this->userId->allowNullValue = false;

}
public function loadStatus() {
if ($this->status == null) {
$this->status = new \Nemundo\Process\Data\Status\StatusExternalType($this, "process_workflow_log_status");
$this->status->tableName = "process_workflow_log";
$this->status->fieldName = "status";
$this->status->aliasFieldName = "process_workflow_log_status";
$this->status->label = "Status";
}
return $this;
}
public function loadWorkflow() {
if ($this->workflow == null) {
$this->workflow = new \Nemundo\Process\Data\Workflow\WorkflowExternalType($this, "process_workflow_log_workflow");
$this->workflow->tableName = "process_workflow_log";
$this->workflow->fieldName = "workflow";
$this->workflow->aliasFieldName = "process_workflow_log_workflow";
$this->workflow->label = "Workflow";
}
return $this;
}
public function loadUser() {
if ($this->user == null) {
$this->user = new \Nemundo\User\Data\User\UserExternalType($this, "process_workflow_log_user");
$this->user->tableName = "process_workflow_log";
$this->user->fieldName = "user";
$this->user->aliasFieldName = "process_workflow_log_user";
$this->user->label = "User";
}
return $this;
}
}