<?php
namespace Nemundo\Process\Content\Data\ContentStatus;
class ContentStatusReader extends \Nemundo\Model\Reader\ModelDataReader {
/**
* @var ContentStatusModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new ContentStatusModel();
}
/**
* @return ContentStatusRow[]
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
* @return ContentStatusRow
*/
public function getRow() {
$dataRow = parent::getRow();
$row = $this->getModelRow($dataRow);
return $row;
}
/**
* @return ContentStatusRow
*/
public function getRowById($id) {
return parent::getRowById($id);
}
private function getModelRow($dataRow) {
$row = new ContentStatusRow($dataRow, $this->model);
$row->model = $this->model;
return $row;
}
}