<?php
namespace Nemundo\Process\App\Assignment\Data\AssignmentSource;
class AssignmentSourceReader extends \Nemundo\Model\Reader\ModelDataReader {
/**
* @var AssignmentSourceModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new AssignmentSourceModel();
}
/**
* @return AssignmentSourceRow[]
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
* @return AssignmentSourceRow
*/
public function getRow() {
$dataRow = parent::getRow();
$row = $this->getModelRow($dataRow);
return $row;
}
/**
* @return AssignmentSourceRow
*/
public function getRowById($id) {
return parent::getRowById($id);
}
private function getModelRow($dataRow) {
$row = new AssignmentSourceRow($dataRow, $this->model);
$row->model = $this->model;
return $row;
}
}