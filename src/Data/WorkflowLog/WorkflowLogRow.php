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
* @var \Nemundo\Process\Data\Status\StatusRow
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
* @var \Nemundo\Process\Data\Workflow\WorkflowRow
*/
public $workflow;

/**
* @var \Nemundo\Core\Type\DateTime\DateTime
*/
public $dateTime;

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
}
private function loadNemundoProcessDataStatusStatusstatusRow($model) {
$this->status = new \Nemundo\Process\Data\Status\StatusRow($this->row, $model);
}
private function loadNemundoProcessDataWorkflowWorkflowworkflowRow($model) {
$this->workflow = new \Nemundo\Process\Data\Workflow\WorkflowRow($this->row, $model);
}
}