<?php
namespace Nemundo\Process\Content\Data\Content;
class ContentReader extends \Nemundo\Model\Reader\ModelDataReader {
/**
* @var ContentModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new ContentModel();
}
/**
* @return ContentRow[]
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
* @return ContentRow
*/
public function getRow() {
$this->addFieldByModel($this->model);
$this->checkExternal($this->model);
$dataRow = parent::getRow();
$row = $this->getModelRow($dataRow);
return $row;
}
/**
* @return ContentRow
*/
public function getRowById($id) {
return parent::getRowById($id);
}
private function getModelRow($dataRow) {
$row = new ContentRow($dataRow, $this->model);
$row->model = $this->model;
return $row;
}
}