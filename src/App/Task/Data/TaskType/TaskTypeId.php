<?php
namespace Nemundo\Process\App\Task\Data\TaskType;
use Nemundo\Model\Id\AbstractModelIdValue;
class TaskTypeId extends AbstractModelIdValue {
/**
* @var TaskTypeModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new TaskTypeModel();
}
}