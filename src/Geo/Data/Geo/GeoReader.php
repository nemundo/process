<?php
namespace Nemundo\Process\Geo\Data\Geo;
class GeoReader extends \Nemundo\Model\Reader\ModelDataReader {
/**
* @var GeoModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new GeoModel();
}
/**
* @return GeoRow[]
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
* @return GeoRow
*/
public function getRow() {
$this->addFieldByModel($this->model);
$this->checkExternal($this->model);
$dataRow = parent::getRow();
$row = $this->getModelRow($dataRow);
return $row;
}
/**
* @return GeoRow
*/
public function getRowById($id) {
return parent::getRowById($id);
}
private function getModelRow($dataRow) {
$row = new GeoRow($dataRow, $this->model);
$row->model = $this->model;
return $row;
}
}