<?php
namespace Nemundo\Process\Template\Data\DeadlineChange;
class DeadlineChangeReader extends \Nemundo\Model\Reader\ModelDataReader {
/**
* @var DeadlineChangeModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new DeadlineChangeModel();
}
/**
* @return DeadlineChangeRow[]
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
* @return DeadlineChangeRow
*/
public function getRow() {
$this->addFieldByModel($this->model);
$this->checkExternal($this->model);
$dataRow = parent::getRow();
$row = $this->getModelRow($dataRow);
return $row;
}
/**
* @return DeadlineChangeRow
*/
public function getRowById($id) {
return parent::getRowById($id);
}
private function getModelRow($dataRow) {
$row = new DeadlineChangeRow($dataRow, $this->model);
$row->model = $this->model;
return $row;
}
}