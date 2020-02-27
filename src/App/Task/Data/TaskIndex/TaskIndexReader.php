<?php
namespace Nemundo\Process\App\Task\Data\TaskIndex;
class TaskIndexReader extends \Nemundo\Model\Reader\ModelDataReader {
/**
* @var TaskIndexModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new TaskIndexModel();
}
/**
* @return TaskIndexRow[]
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
* @return TaskIndexRow
*/
public function getRow() {
$dataRow = parent::getRow();
$row = $this->getModelRow($dataRow);
return $row;
}
/**
* @return TaskIndexRow
*/
public function getRowById($id) {
return parent::getRowById($id);
}
private function getModelRow($dataRow) {
$row = new TaskIndexRow($dataRow, $this->model);
$row->model = $this->model;
return $row;
}
}