<?php
namespace Nemundo\Process\Template\Data\SourceLog;
class SourceLogReader extends \Nemundo\Model\Reader\ModelDataReader {
/**
* @var SourceLogModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new SourceLogModel();
}
/**
* @return SourceLogRow[]
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
* @return SourceLogRow
*/
public function getRow() {
$dataRow = parent::getRow();
$row = $this->getModelRow($dataRow);
return $row;
}
/**
* @return SourceLogRow
*/
public function getRowById($id) {
return parent::getRowById($id);
}
private function getModelRow($dataRow) {
$row = new SourceLogRow($dataRow, $this->model);
$row->model = $this->model;
return $row;
}
}