<?php
namespace Nemundo\Process\Template\Data\TemplateDateLog;
class TemplateDateLogReader extends \Nemundo\Model\Reader\ModelDataReader {
/**
* @var TemplateDateLogModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new TemplateDateLogModel();
}
/**
* @return TemplateDateLogRow[]
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
* @return TemplateDateLogRow
*/
public function getRow() {
$dataRow = parent::getRow();
$row = $this->getModelRow($dataRow);
return $row;
}
/**
* @return TemplateDateLogRow
*/
public function getRowById($id) {
return parent::getRowById($id);
}
private function getModelRow($dataRow) {
$row = new TemplateDateLogRow($dataRow, $this->model);
$row->model = $this->model;
return $row;
}
}