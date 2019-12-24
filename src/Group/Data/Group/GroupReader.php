<?php
namespace Nemundo\Process\Group\Data\Group;
class GroupReader extends \Nemundo\Model\Reader\ModelDataReader {
/**
* @var GroupModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new GroupModel();
}
/**
* @return GroupRow[]
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
* @return GroupRow
*/
public function getRow() {
$this->addFieldByModel($this->model);
$this->checkExternal($this->model);
$dataRow = parent::getRow();
$row = $this->getModelRow($dataRow);
return $row;
}
/**
* @return GroupRow
*/
public function getRowById($id) {
return parent::getRowById($id);
}
private function getModelRow($dataRow) {
$row = new GroupRow($dataRow, $this->model);
$row->model = $this->model;
return $row;
}
}