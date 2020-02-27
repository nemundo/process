<?php
namespace Nemundo\Process\App\Task\Data\TaskType;
class TaskTypeReader extends \Nemundo\Model\Reader\ModelDataReader {
/**
* @var TaskTypeModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new TaskTypeModel();
}
/**
* @return TaskTypeRow[]
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
* @return TaskTypeRow
*/
public function getRow() {
$dataRow = parent::getRow();
$row = $this->getModelRow($dataRow);
return $row;
}
/**
* @return TaskTypeRow
*/
public function getRowById($id) {
return parent::getRowById($id);
}
private function getModelRow($dataRow) {
$row = new TaskTypeRow($dataRow, $this->model);
$row->model = $this->model;
return $row;
}
}