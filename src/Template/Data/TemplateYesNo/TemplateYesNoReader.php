<?php
namespace Nemundo\Process\Template\Data\TemplateYesNo;
class TemplateYesNoReader extends \Nemundo\Model\Reader\ModelDataReader {
/**
* @var TemplateYesNoModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new TemplateYesNoModel();
}
/**
* @return TemplateYesNoRow[]
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
* @return TemplateYesNoRow
*/
public function getRow() {
$dataRow = parent::getRow();
$row = $this->getModelRow($dataRow);
return $row;
}
/**
* @return TemplateYesNoRow
*/
public function getRowById($id) {
return parent::getRowById($id);
}
private function getModelRow($dataRow) {
$row = new TemplateYesNoRow($dataRow, $this->model);
$row->model = $this->model;
return $row;
}
}