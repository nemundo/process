<?php
namespace Nemundo\Process\Template\Data\TemplateDecimalNumber;
class TemplateDecimalNumberReader extends \Nemundo\Model\Reader\ModelDataReader {
/**
* @var TemplateDecimalNumberModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new TemplateDecimalNumberModel();
}
/**
* @return TemplateDecimalNumberRow[]
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
* @return TemplateDecimalNumberRow
*/
public function getRow() {
$dataRow = parent::getRow();
$row = $this->getModelRow($dataRow);
return $row;
}
/**
* @return TemplateDecimalNumberRow
*/
public function getRowById($id) {
return parent::getRowById($id);
}
private function getModelRow($dataRow) {
$row = new TemplateDecimalNumberRow($dataRow, $this->model);
$row->model = $this->model;
return $row;
}
}