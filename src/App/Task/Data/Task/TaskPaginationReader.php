<?php
namespace Nemundo\Process\App\Task\Data\Task;
class TaskPaginationReader extends \Nemundo\Model\Reader\AbstractPaginationModelDataReader {
/**
* @var TaskModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new TaskModel();
}
/**
* @return TaskRow[]
*/
public function getData() {
$list = [];
foreach (parent::getData() as $dataRow) {
$row = new TaskRow($dataRow, $this->model);
$list[] = $row;
}
return $list;
}
}