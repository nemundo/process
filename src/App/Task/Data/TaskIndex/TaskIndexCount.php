<?php
namespace Nemundo\Process\App\Task\Data\TaskIndex;
class TaskIndexCount extends \Nemundo\Model\Count\AbstractModelDataCount {
/**
* @var TaskIndexModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new TaskIndexModel();
}
}