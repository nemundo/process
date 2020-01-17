<?php
namespace Nemundo\Process\Template\Data\TemplateFileDelete;
class TemplateFileDeleteReader extends \Nemundo\Model\Reader\ModelDataReader {
/**
* @var TemplateFileDeleteModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new TemplateFileDeleteModel();
}
/**
* @return TemplateFileDeleteRow[]
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
* @return TemplateFileDeleteRow
*/
public function getRow() {
$this->addFieldByModel($this->model);
$this->checkExternal($this->model);
$dataRow = parent::getRow();
$row = $this->getModelRow($dataRow);
return $row;
}
/**
* @return TemplateFileDeleteRow
*/
public function getRowById($id) {
return parent::getRowById($id);
}
private function getModelRow($dataRow) {
$row = new TemplateFileDeleteRow($dataRow, $this->model);
$row->model = $this->model;
return $row;
}
}