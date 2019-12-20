<?php
namespace Nemundo\Process\Content\Data\Access;
class AccessReader extends \Nemundo\Model\Reader\ModelDataReader {
/**
* @var AccessModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new AccessModel();
}
/**
* @return AccessRow[]
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
* @return AccessRow
*/
public function getRow() {
$this->addFieldByModel($this->model);
$this->checkExternal($this->model);
$dataRow = parent::getRow();
$row = $this->getModelRow($dataRow);
return $row;
}
/**
* @return AccessRow
*/
public function getRowById($id) {
return parent::getRowById($id);
}
private function getModelRow($dataRow) {
$row = new AccessRow($dataRow, $this->model);
$row->model = $this->model;
return $row;
}
}