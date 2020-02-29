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
* @return \Nemundo\Process\App\Task\Row\TaskIndexCustomRow[]
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
* @return \Nemundo\Process\App\Task\Row\TaskIndexCustomRow
*/
public function getRow() {
$dataRow = parent::getRow();
$row = $this->getModelRow($dataRow);
return $row;
}
/**
* @return \Nemundo\Process\App\Task\Row\TaskIndexCustomRow
*/
public function getRowById($id) {
return parent::getRowById($id);
}
private function getModelRow($dataRow) {
$row = new \Nemundo\Process\App\Task\Row\TaskIndexCustomRow($dataRow, $this->model);
$row->model = $this->model;
return $row;
}
}