<?php
namespace Nemundo\Process\App\Task\Data\Task;
use Nemundo\Model\Data\AbstractModelUpdate;
class TaskUpdate extends AbstractModelUpdate {
/**
* @var TaskModel
*/
public $model;

/**
* @var string
*/
public $sourceId;

/**
* @var string
*/
public $assignmentId;

/**
* @var \Nemundo\Core\Type\DateTime\Date
*/
public $deadline;

/**
* @var string
*/
public $task;

/**
* @var bool
*/
public $closed;

public function __construct() {
parent::__construct();
$this->model = new TaskModel();
$this->deadline = new \Nemundo\Core\Type\DateTime\Date();
}
public function update() {
$this->typeValueList->setModelValue($this->model->sourceId, $this->sourceId);
$this->typeValueList->setModelValue($this->model->assignmentId, $this->assignmentId);
$property = new \Nemundo\Model\Data\Property\DateTime\DateDataProperty($this->model->deadline, $this->typeValueList);
$property->setValue($this->deadline);
$this->typeValueList->setModelValue($this->model->task, $this->task);
$this->typeValueList->setModelValue($this->model->closed, $this->closed);
parent::update();
}
}