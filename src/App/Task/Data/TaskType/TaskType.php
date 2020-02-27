<?php
namespace Nemundo\Process\App\Task\Data\TaskType;
class TaskType extends \Nemundo\Model\Data\AbstractModelData {
/**
* @var TaskTypeModel
*/
protected $model;

/**
* @var string
*/
public $taskTypeId;

public function __construct() {
parent::__construct();
$this->model = new TaskTypeModel();
}
public function save() {
$this->typeValueList->setModelValue($this->model->taskTypeId, $this->taskTypeId);
$id = parent::save();
return $id;
}
}