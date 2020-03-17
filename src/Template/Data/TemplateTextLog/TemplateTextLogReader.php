<?php
namespace Nemundo\Process\Template\Data\TemplateTextLog;
class TemplateTextLogReader extends \Nemundo\Model\Reader\ModelDataReader {
/**
* @var TemplateTextLogModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new TemplateTextLogModel();
}
/**
* @return TemplateTextLogRow[]
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
* @return TemplateTextLogRow
*/
public function getRow() {
$dataRow = parent::getRow();
$row = $this->getModelRow($dataRow);
return $row;
}
/**
* @return TemplateTextLogRow
*/
public function getRowById($id) {
return parent::getRowById($id);
}
private function getModelRow($dataRow) {
$row = new TemplateTextLogRow($dataRow, $this->model);
$row->model = $this->model;
return $row;
}
}