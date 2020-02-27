<?php
namespace Nemundo\Process\App\Task\Data\TaskType;
class TaskTypeCount extends \Nemundo\Model\Count\AbstractModelDataCount {
/**
* @var TaskTypeModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new TaskTypeModel();
}
}