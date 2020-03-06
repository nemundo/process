<?php
namespace Nemundo\Process\Template\Data\TemplateMultiImage;
class TemplateMultiImageReader extends \Nemundo\Model\Reader\ModelDataReader {
/**
* @var TemplateMultiImageModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new TemplateMultiImageModel();
}
/**
* @return TemplateMultiImageRow[]
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
* @return TemplateMultiImageRow
*/
public function getRow() {
$dataRow = parent::getRow();
$row = $this->getModelRow($dataRow);
return $row;
}
/**
* @return TemplateMultiImageRow
*/
public function getRowById($id) {
return parent::getRowById($id);
}
private function getModelRow($dataRow) {
$row = new TemplateMultiImageRow($dataRow, $this->model);
$row->model = $this->model;
return $row;
}
}