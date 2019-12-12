<?php
namespace Nemundo\Process\Template\Data\UserAssignmentLog;
class UserAssignmentLogReader extends \Nemundo\Model\Reader\ModelDataReader {
/**
* @var UserAssignmentLogModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new UserAssignmentLogModel();
}
/**
* @return UserAssignmentLogRow[]
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
* @return UserAssignmentLogRow
*/
public function getRow() {
$this->addFieldByModel($this->model);
$this->checkExternal($this->model);
$dataRow = parent::getRow();
$row = $this->getModelRow($dataRow);
return $row;
}
/**
* @return UserAssignmentLogRow
*/
public function getRowById($id) {
return parent::getRowById($id);
}
private function getModelRow($dataRow) {
$row = new UserAssignmentLogRow($dataRow, $this->model);
$row->model = $this->model;
return $row;
}
}