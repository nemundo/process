<?php
namespace Nemundo\Process\Data\Process;
class ProcessReader extends \Nemundo\Model\Reader\ModelDataReader {
/**
* @var ProcessModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new ProcessModel();
}
/**
* @return \Nemundo\Process\Row\ProcessCustomRow[]
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
* @return \Nemundo\Process\Row\ProcessCustomRow
*/
public function getRow() {
$this->addFieldByModel($this->model);
$this->checkExternal($this->model);
$dataRow = parent::getRow();
$row = $this->getModelRow($dataRow);
return $row;
}
/**
* @return \Nemundo\Process\Row\ProcessCustomRow
*/
public function getRowById($id) {
return parent::getRowById($id);
}
private function getModelRow($dataRow) {
$row = new \Nemundo\Process\Row\ProcessCustomRow($dataRow, $this->model);
$row->model = $this->model;
return $row;
}
}