<?php
namespace Nemundo\Process\Data\WorkflowLog;
use Nemundo\Model\Data\AbstractModelUpdate;
class WorkflowLogUpdate extends AbstractModelUpdate {
/**
* @var WorkflowLogModel
*/
public $model;

/**
* @var string
*/
public $statusId;

/**
* @var string
*/
public $dataId;

/**
* @var string
*/
public $workflowId;

/**
* @var \Nemundo\Core\Type\DateTime\DateTime
*/
public $dateTime;

public function __construct() {
parent::__construct();
$this->model = new WorkflowLogModel();
$this->dateTime = new \Nemundo\Core\Type\DateTime\DateTime();
}
public function update() {
$this->typeValueList->setModelValue($this->model->statusId, $this->statusId);
$this->typeValueList->setModelValue($this->model->dataId, $this->dataId);
$this->typeValueList->setModelValue($this->model->workflowId, $this->workflowId);
$property = new \Nemundo\Model\Data\Property\DateTime\DateTimeDataProperty($this->model->dateTime, $this->typeValueList);
$property->setValue($this->dateTime);
parent::update();
}
}