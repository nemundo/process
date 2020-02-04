<?php
namespace Nemundo\Process\Template\Data\TemplateText;
class TemplateTextReader extends \Nemundo\Model\Reader\ModelDataReader {
/**
* @var TemplateTextModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new TemplateTextModel();
}
/**
* @return TemplateTextRow[]
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
* @return TemplateTextRow
*/
public function getRow() {
$dataRow = parent::getRow();
$row = $this->getModelRow($dataRow);
return $row;
}
/**
* @return TemplateTextRow
*/
public function getRowById($id) {
return parent::getRowById($id);
}
private function getModelRow($dataRow) {
$row = new TemplateTextRow($dataRow, $this->model);
$row->model = $this->model;
return $row;
}
}