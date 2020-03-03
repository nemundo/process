<?php
namespace Nemundo\Process\App\Task\Data\Task;
class TaskCount extends \Nemundo\Model\Count\AbstractModelDataCount {
/**
* @var TaskModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new TaskModel();
}
}