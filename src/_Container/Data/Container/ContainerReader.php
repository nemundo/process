<?php
namespace Nemundo\Process\Container\Data\Container;
class ContainerReader extends \Nemundo\Model\Reader\ModelDataReader {
/**
* @var ContainerModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new ContainerModel();
}
/**
* @return ContainerRow[]
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
* @return ContainerRow
*/
public function getRow() {
$dataRow = parent::getRow();
$row = $this->getModelRow($dataRow);
return $row;
}
/**
* @return ContainerRow
*/
public function getRowById($id) {
return parent::getRowById($id);
}
private function getModelRow($dataRow) {
$row = new ContainerRow($dataRow, $this->model);
$row->model = $this->model;
return $row;
}
}