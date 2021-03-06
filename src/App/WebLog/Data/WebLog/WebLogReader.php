<?php
namespace Nemundo\Process\App\WebLog\Data\WebLog;
class WebLogReader extends \Nemundo\Model\Reader\ModelDataReader {
/**
* @var WebLogModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new WebLogModel();
}
/**
* @return WebLogRow[]
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
* @return WebLogRow
*/
public function getRow() {
$dataRow = parent::getRow();
$row = $this->getModelRow($dataRow);
return $row;
}
/**
* @return WebLogRow
*/
public function getRowById($id) {
return parent::getRowById($id);
}
private function getModelRow($dataRow) {
$row = new WebLogRow($dataRow, $this->model);
$row->model = $this->model;
return $row;
}
}