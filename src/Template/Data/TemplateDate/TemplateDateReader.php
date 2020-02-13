<?php
namespace Nemundo\Process\Template\Data\TemplateDate;
class TemplateDateReader extends \Nemundo\Model\Reader\ModelDataReader {
/**
* @var TemplateDateModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new TemplateDateModel();
}
/**
* @return TemplateDateRow[]
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
* @return TemplateDateRow
*/
public function getRow() {
$dataRow = parent::getRow();
$row = $this->getModelRow($dataRow);
return $row;
}
/**
* @return TemplateDateRow
*/
public function getRowById($id) {
return parent::getRowById($id);
}
private function getModelRow($dataRow) {
$row = new TemplateDateRow($dataRow, $this->model);
$row->model = $this->model;
return $row;
}
}