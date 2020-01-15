<?php
namespace Nemundo\Process\Template\Data\TemplateFile;
class TemplateFileReader extends \Nemundo\Model\Reader\ModelDataReader {
/**
* @var TemplateFileModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new TemplateFileModel();
}
/**
* @return TemplateFileRow[]
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
* @return TemplateFileRow
*/
public function getRow() {
$this->addFieldByModel($this->model);
$this->checkExternal($this->model);
$dataRow = parent::getRow();
$row = $this->getModelRow($dataRow);
return $row;
}
/**
* @return TemplateFileRow
*/
public function getRowById($id) {
return parent::getRowById($id);
}
private function getModelRow($dataRow) {
$row = new TemplateFileRow($dataRow, $this->model);
$row->model = $this->model;
return $row;
}
}