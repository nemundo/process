<?php
namespace Nemundo\Process\Template\Data\TemplateImage;
class TemplateImageReader extends \Nemundo\Model\Reader\ModelDataReader {
/**
* @var TemplateImageModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new TemplateImageModel();
}
/**
* @return TemplateImageRow[]
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
* @return TemplateImageRow
*/
public function getRow() {
$dataRow = parent::getRow();
$row = $this->getModelRow($dataRow);
return $row;
}
/**
* @return TemplateImageRow
*/
public function getRowById($id) {
return parent::getRowById($id);
}
private function getModelRow($dataRow) {
$row = new TemplateImageRow($dataRow, $this->model);
$row->model = $this->model;
return $row;
}
}