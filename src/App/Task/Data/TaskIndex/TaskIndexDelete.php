<?php
namespace Nemundo\Process\App\Task\Data\TaskIndex;
class TaskIndexDelete extends \Nemundo\Model\Delete\AbstractModelDelete {
/**
* @var TaskIndexModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new TaskIndexModel();
}
}