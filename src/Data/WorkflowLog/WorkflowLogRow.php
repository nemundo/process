<?php
namespace Nemundo\Process\Data\WorkflowLog;
class WorkflowLogRow extends \Nemundo\Model\Row\AbstractModelDataRow {
/**
* @var \Nemundo\Model\Row\AbstractModelDataRow
*/
private $row;

/**
* @var WorkflowLogModel
*/
public $model;

/**
* @var string
*/
public $id;

/**
* @var string
*/
public $statusId;

/**
* @var \Nemundo\Process\Row\StatusCustomRow
*/
public $status;

/**
* @var string
*/
public $dataId;

/**
* @var string
*/
public $workflowId;

/**
* @var \Nemundo\Process\Row\WorkflowCustomRow
*/
public $workflow;

/**
* @var \Nemundo\Core\Type\DateTime\DateTime
*/
public $dateTime;

/**
* @var string
*/
public $userId;

/**
* @var \Nemundo\User\Data\User\UserRow
*/
public $user;

public function __construct(\Nemundo\Db\Row\AbstractDataRow $row, $model) {
parent::__construct($row->getData());
$this->row = $row;
$this->id = $this->getModelValue($model->id);
$this->statusId = $this->getModelValue($model->statusId);
if ($model->status !== null) {
$this->loadNemundoProcessDataStatusStatusstatusRow($model->status);
}
$this->dataId = $this->getModelValue($model->dataId);
$this->workflowId = $this->getModelValue($model->workflowId);
if ($model->workflow !== null) {
$this->loadNemundoProcessDataWorkflowWorkflowworkflowRow($model->workflow);
}
$this->dateTime = new \Nemundo\Core\Type\DateTime\DateTime($this->getModelValue($model->dateTime));
$this->userId = $this->getModelValue($model->userId);
if ($model->user !== null) {
$this->loadNemundoUserDataUserUseruserRow($model->user);
}
}
private function loadNemundoProcessDataStatusStatusstatusRow($model) {
$this->status = new \Nemundo\Process\Row\StatusCustomRow($this->row, $model);
}
private function loadNemundoProcessDataWorkflowWorkflowworkflowRow($model) {
$this->workflow = new \Nemundo\Process\Row\WorkflowCustomRow($this->row, $model);
}
private function loadNemundoUserDataUserUseruserRow($model) {
$this->user = new \Nemundo\User\Data\User\UserRow($this->row, $model);
}
}