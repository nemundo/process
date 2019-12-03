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

/**
* @var string
*/
public $userId;

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
$this->typeValueList->setModelValue($this->model->userId, $this->userId);
$id = parent::save();
return $id;
}
}