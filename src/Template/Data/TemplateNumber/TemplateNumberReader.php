<?php
namespace Nemundo\Process\Template\Data\TemplateNumber;
class TemplateNumberReader extends \Nemundo\Model\Reader\ModelDataReader {
/**
* @var TemplateNumberModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new TemplateNumberModel();
}
/**
* @return TemplateNumberRow[]
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
* @return TemplateNumberRow
*/
public function getRow() {
$dataRow = parent::getRow();
$row = $this->getModelRow($dataRow);
return $row;
}
/**
* @return TemplateNumberRow
*/
public function getRowById($id) {
return parent::getRowById($id);
}
private function getModelRow($dataRow) {
$row = new TemplateNumberRow($dataRow, $this->model);
$row->model = $this->model;
return $row;
}
}