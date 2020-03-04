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
* @return \Nemundo\Process\Group\Row\GroupCustomRow[]
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
* @return \Nemundo\Process\Group\Row\GroupCustomRow
*/
public function getRow() {
$dataRow = parent::getRow();
$row = $this->getModelRow($dataRow);
return $row;
}
/**
* @return \Nemundo\Process\Group\Row\GroupCustomRow
*/
public function getRowById($id) {
return parent::getRowById($id);
}
private function getModelRow($dataRow) {
$row = new \Nemundo\Process\Group\Row\GroupCustomRow($dataRow, $this->model);
$row->model = $this->model;
return $row;
}
}