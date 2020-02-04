<?php
namespace Nemundo\Process\App\Assignment\Data\Assignment;
class AssignmentReader extends \Nemundo\Model\Reader\ModelDataReader {
/**
* @var AssignmentModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new AssignmentModel();
}
/**
* @return AssignmentRow[]
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
* @return AssignmentRow
*/
public function getRow() {
$dataRow = parent::getRow();
$row = $this->getModelRow($dataRow);
return $row;
}
/**
* @return AssignmentRow
*/
public function getRowById($id) {
return parent::getRowById($id);
}
private function getModelRow($dataRow) {
$row = new AssignmentRow($dataRow, $this->model);
$row->model = $this->model;
return $row;
}
}