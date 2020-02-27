<?php
namespace Nemundo\Process\App\Task\Data\TaskType;
class TaskTypeValue extends \Nemundo\Model\Value\AbstractModelDataValue {
/**
* @var TaskTypeModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new TaskTypeModel();
}
}