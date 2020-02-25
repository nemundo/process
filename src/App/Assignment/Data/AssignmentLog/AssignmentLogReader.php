<?php
namespace Nemundo\Process\App\Assignment\Data\AssignmentLog;
class AssignmentLogReader extends \Nemundo\Model\Reader\ModelDataReader {
/**
* @var AssignmentLogModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new AssignmentLogModel();
}
/**
* @return AssignmentLogRow[]
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
* @return AssignmentLogRow
*/
public function getRow() {
$dataRow = parent::getRow();
$row = $this->getModelRow($dataRow);
return $row;
}
/**
* @return AssignmentLogRow
*/
public function getRowById($id) {
return parent::getRowById($id);
}
private function getModelRow($dataRow) {
$row = new AssignmentLogRow($dataRow, $this->model);
$row->model = $this->model;
return $row;
}
}