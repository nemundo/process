<?php
namespace Nemundo\Process\App\Task\Data\TaskType;
use Nemundo\Model\Data\AbstractModelUpdate;
class TaskTypeUpdate extends AbstractModelUpdate {
/**
* @var TaskTypeModel
*/
public $model;

/**
* @var string
*/
public $taskTypeId;

/**
* @var bool
*/
public $setupStatus;

public function __construct() {
parent::__construct();
$this->model = new TaskTypeModel();
}
public function update() {
$this->typeValueList->setModelValue($this->model->taskTypeId, $this->taskTypeId);
$this->typeValueList->setModelValue($this->model->setupStatus, $this->setupStatus);
parent::update();
}
}