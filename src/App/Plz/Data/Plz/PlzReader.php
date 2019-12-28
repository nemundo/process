<?php
namespace Nemundo\Process\App\Plz\Data\Plz;
class PlzReader extends \Nemundo\Model\Reader\ModelDataReader {
/**
* @var PlzModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new PlzModel();
}
/**
* @return PlzRow[]
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
* @return PlzRow
*/
public function getRow() {
$this->addFieldByModel($this->model);
$this->checkExternal($this->model);
$dataRow = parent::getRow();
$row = $this->getModelRow($dataRow);
return $row;
}
/**
* @return PlzRow
*/
public function getRowById($id) {
return parent::getRowById($id);
}
private function getModelRow($dataRow) {
$row = new PlzRow($dataRow, $this->model);
$row->model = $this->model;
return $row;
}
}