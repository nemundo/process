<?php
namespace Nemundo\Process\App\Task\Data\TaskType;
class TaskTypeDelete extends \Nemundo\Model\Delete\AbstractModelDelete {
/**
* @var TaskTypeModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new TaskTypeModel();
}
}