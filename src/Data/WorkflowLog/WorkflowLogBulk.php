<?php
namespace Nemundo\Process\Data\WorkflowLog;
class WorkflowLogBulk extends \Nemundo\Model\Data\AbstractModelDataBulk {
/**
* @var WorkflowLogModel
*/
protected $model;

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
public function save() {
$this->typeValueList->setModelValue($this->model->statusId, $this->statusId);
$this->typeValueList->setModelValue($this->model->dataId, $this->dataId);
$this->typeValueList->setModelValue($this->model->workflowId, $this->workflowId);
$property = new \Nemundo\Model\Data\Property\DateTime\DateTimeDataProperty($this->model->dateTime, $this->typeValueList);
$property->setValue($this->dateTime);
$id = parent::save();
return $id;
}
}