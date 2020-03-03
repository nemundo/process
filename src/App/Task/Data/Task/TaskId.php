<?php
namespace Nemundo\Process\App\Task\Data\Task;
use Nemundo\Model\Id\AbstractModelIdValue;
class TaskId extends AbstractModelIdValue {
/**
* @var TaskModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new TaskModel();
}
}