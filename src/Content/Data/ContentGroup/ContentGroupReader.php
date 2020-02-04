<?php
namespace Nemundo\Process\Content\Data\ContentGroup;
class ContentGroupReader extends \Nemundo\Model\Reader\ModelDataReader {
/**
* @var ContentGroupModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new ContentGroupModel();
}
/**
* @return ContentGroupRow[]
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
* @return ContentGroupRow
*/
public function getRow() {
$dataRow = parent::getRow();
$row = $this->getModelRow($dataRow);
return $row;
}
/**
* @return ContentGroupRow
*/
public function getRowById($id) {
return parent::getRowById($id);
}
private function getModelRow($dataRow) {
$row = new ContentGroupRow($dataRow, $this->model);
$row->model = $this->model;
return $row;
}
}