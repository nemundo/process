<?php
namespace Nemundo\Process\App\Task\Data\Task;
class TaskDelete extends \Nemundo\Model\Delete\AbstractModelDelete {
/**
* @var TaskModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new TaskModel();
}
}