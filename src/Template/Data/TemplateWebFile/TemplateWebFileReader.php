<?php
namespace Nemundo\Process\Template\Data\TemplateWebFile;
class TemplateWebFileReader extends \Nemundo\Model\Reader\ModelDataReader {
/**
* @var TemplateWebFileModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new TemplateWebFileModel();
}
/**
* @return TemplateWebFileRow[]
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
* @return TemplateWebFileRow
*/
public function getRow() {
$dataRow = parent::getRow();
$row = $this->getModelRow($dataRow);
return $row;
}
/**
* @return TemplateWebFileRow
*/
public function getRowById($id) {
return parent::getRowById($id);
}
private function getModelRow($dataRow) {
$row = new TemplateWebFileRow($dataRow, $this->model);
$row->model = $this->model;
return $row;
}
}