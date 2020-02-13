<?php
namespace Nemundo\Process\Template\Data\TemplateMultiFile;
class TemplateMultiFileReader extends \Nemundo\Model\Reader\ModelDataReader {
/**
* @var TemplateMultiFileModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new TemplateMultiFileModel();
}
/**
* @return TemplateMultiFileRow[]
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
* @return TemplateMultiFileRow
*/
public function getRow() {
$dataRow = parent::getRow();
$row = $this->getModelRow($dataRow);
return $row;
}
/**
* @return TemplateMultiFileRow
*/
public function getRowById($id) {
return parent::getRowById($id);
}
private function getModelRow($dataRow) {
$row = new TemplateMultiFileRow($dataRow, $this->model);
$row->model = $this->model;
return $row;
}
}