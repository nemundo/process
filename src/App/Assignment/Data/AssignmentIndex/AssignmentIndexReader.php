<?php
namespace Nemundo\Process\App\Assignment\Data\AssignmentIndex;
class AssignmentIndexReader extends \Nemundo\Model\Reader\ModelDataReader {
/**
* @var AssignmentIndexModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new AssignmentIndexModel();
}
/**
* @return AssignmentIndexRow[]
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
* @return AssignmentIndexRow
*/
public function getRow() {
$dataRow = parent::getRow();
$row = $this->getModelRow($dataRow);
return $row;
}
/**
* @return AssignmentIndexRow
*/
public function getRowById($id) {
return parent::getRowById($id);
}
private function getModelRow($dataRow) {
$row = new AssignmentIndexRow($dataRow, $this->model);
$row->model = $this->model;
return $row;
}
}