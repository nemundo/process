<?php
namespace Nemundo\Process\App\Assignment\Data\AssignmentStatus;
class AssignmentStatusReader extends \Nemundo\Model\Reader\ModelDataReader {
/**
* @var AssignmentStatusModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new AssignmentStatusModel();
}
/**
* @return AssignmentStatusRow[]
*/
public function getData() {
$this->addFieldByModel($this->model);
$this->checkExternal($this->model);
$list = [];
foreach (parent::getData() as $dataRow) {
$row = $this->getModelRow($dataRow);
$list[] = $row;
}
return $list;
}
/**
* @return AssignmentStatusRow
*/
public function getRow() {
$this->addFieldByModel($this->model);
$this->checkExternal($this->model);
$dataRow = parent::getRow();
$row = $this->getModelRow($dataRow);
return $row;
}
/**
* @return AssignmentStatusRow
*/
public function getRowById($id) {
return parent::getRowById($id);
}
private function getModelRow($dataRow) {
$row = new AssignmentStatusRow($dataRow, $this->model);
$row->model = $this->model;
return $row;
}
}