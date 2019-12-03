<?php
namespace Nemundo\Process\Data\Workflow;
class WorkflowRow extends \Nemundo\Model\Row\AbstractModelDataRow {
/**
* @var \Nemundo\Model\Row\AbstractModelDataRow
*/
private $row;

/**
* @var WorkflowModel
*/
public $model;

/**
* @var string
*/
public $id;

/**
* @var int
*/
public $number;

/**
* @var string
*/
public $workflowNumber;

/**
* @var string
*/
public $subject;

/**
* @var string
*/
public $processId;

/**
* @var \Nemundo\Process\Row\ProcessCustomRow
*/
public $process;

/**
* @var bool
*/
public $workflowClosed;

/**
* @var string
*/
public $statusId;

/**
* @var \Nemundo\Process\Row\StatusCustomRow
*/
public $status;

public function __construct(\Nemundo\Db\Row\AbstractDataRow $row, $model) {
parent::__construct($row->getData());
$this->row = $row;
$this->id = $this->getModelValue($model->id);
$this->number = intval($this->getModelValue($model->number));
$this->workflowNumber = $this->getModelValue($model->workflowNumber);
$this->subject = $this->getModelValue($model->subject);
$this->processId = $this->getModelValue($model->processId);
if ($model->process !== null) {
$this->loadNemundoProcessDataProcessProcessprocessRow($model->process);
}
$this->workflowClosed = boolval($this->getModelValue($model->workflowClosed));
$this->statusId = $this->getModelValue($model->statusId);
if ($model->status !== null) {
$this->loadNemundoProcessDataStatusStatusstatusRow($model->status);
}
}
private function loadNemundoProcessDataProcessProcessprocessRow($model) {
$this->process = new \Nemundo\Process\Row\ProcessCustomRow($this->row, $model);
}
private function loadNemundoProcessDataStatusStatusstatusRow($model) {
$this->status = new \Nemundo\Process\Row\StatusCustomRow($this->row, $model);
}
}