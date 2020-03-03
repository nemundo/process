<?php
namespace Nemundo\Process\App\Task\Data\Task;
class TaskValue extends \Nemundo\Model\Value\AbstractModelDataValue {
/**
* @var TaskModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new TaskModel();
}
}