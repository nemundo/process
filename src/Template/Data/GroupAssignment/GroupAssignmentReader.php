<?php
namespace Nemundo\Process\Template\Data\GroupAssignment;
class GroupAssignmentReader extends \Nemundo\Model\Reader\ModelDataReader {
/**
* @var GroupAssignmentModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new GroupAssignmentModel();
}
/**
* @return GroupAssignmentRow[]
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
* @return GroupAssignmentRow
*/
public function getRow() {
$this->addFieldByModel($this->model);
$this->checkExternal($this->model);
$dataRow = parent::getRow();
$row = $this->getModelRow($dataRow);
return $row;
}
/**
* @return GroupAssignmentRow
*/
public function getRowById($id) {
return parent::getRowById($id);
}
private function getModelRow($dataRow) {
$row = new GroupAssignmentRow($dataRow, $this->model);
$row->model = $this->model;
return $row;
}
}