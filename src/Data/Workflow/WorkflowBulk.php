<?php
namespace Nemundo\Process\Data\Workflow;
class WorkflowBulk extends \Nemundo\Model\Data\AbstractModelDataBulk {
/**
* @var WorkflowModel
*/
protected $model;

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
* @var bool
*/
public $workflowClosed;

/**
* @var string
*/
public $statusId;

public function __construct() {
parent::__construct();
$this->model = new WorkflowModel();
}
public function save() {
$this->typeValueList->setModelValue($this->model->number, $this->number);
$this->typeValueList->setModelValue($this->model->workflowNumber, $this->workflowNumber);
$this->typeValueList->setModelValue($this->model->subject, $this->subject);
$this->typeValueList->setModelValue($this->model->processId, $this->processId);
$this->typeValueList->setModelValue($this->model->workflowClosed, $this->workflowClosed);
$this->typeValueList->setModelValue($this->model->statusId, $this->statusId);
$id = parent::save();
return $id;
}
}