<?php
namespace Nemundo\Process\Template\Data\TemplateImageIndex;
class TemplateImageIndexReader extends \Nemundo\Model\Reader\ModelDataReader {
/**
* @var TemplateImageIndexModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new TemplateImageIndexModel();
}
/**
* @return TemplateImageIndexRow[]
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
* @return TemplateImageIndexRow
*/
public function getRow() {
$dataRow = parent::getRow();
$row = $this->getModelRow($dataRow);
return $row;
}
/**
* @return TemplateImageIndexRow
*/
public function getRowById($id) {
return parent::getRowById($id);
}
private function getModelRow($dataRow) {
$row = new TemplateImageIndexRow($dataRow, $this->model);
$row->model = $this->model;
return $row;
}
}