<?php
namespace Nemundo\Process\App\Task\Data\Task;
class TaskReader extends \Nemundo\Model\Reader\ModelDataReader {
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
$row = $this->getModelRow($dataRow);
$list[] = $row;
}
return $list;
}
/**
* @return TaskRow
*/
public function getRow() {
$dataRow = parent::getRow();
$row = $this->getModelRow($dataRow);
return $row;
}
/**
* @return TaskRow
*/
public function getRowById($id) {
return parent::getRowById($id);
}
private function getModelRow($dataRow) {
$row = new TaskRow($dataRow, $this->model);
$row->model = $this->model;
return $row;
}
}