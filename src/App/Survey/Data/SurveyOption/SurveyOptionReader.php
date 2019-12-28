<?php
namespace Nemundo\Process\App\Survey\Data\SurveyOption;
class SurveyOptionReader extends \Nemundo\Model\Reader\ModelDataReader {
/**
* @var SurveyOptionModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new SurveyOptionModel();
}
/**
* @return SurveyOptionRow[]
*/
public function getData() {
$this->addFieldByModel($this->model);
$this->checkExternal($this->model);
$list = [];
foreach (parent::getData() as $dataRow) {
$row = $this->getModelRow($dataRow);
$list[] = $row;
}
return $list;
}
/**
* @return SurveyOptionRow
*/
public function getRow() {
$this->addFieldByModel($this->model);
$this->checkExternal($this->model);
$dataRow = parent::getRow();
$row = $this->getModelRow($dataRow);
return $row;
}
/**
* @return SurveyOptionRow
*/
public function getRowById($id) {
return parent::getRowById($id);
}
private function getModelRow($dataRow) {
$row = new SurveyOptionRow($dataRow, $this->model);
$row->model = $this->model;
return $row;
}
}