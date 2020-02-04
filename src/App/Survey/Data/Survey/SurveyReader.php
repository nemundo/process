<?php
namespace Nemundo\Process\App\Survey\Data\Survey;
class SurveyReader extends \Nemundo\Model\Reader\ModelDataReader {
/**
* @var SurveyModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new SurveyModel();
}
/**
* @return SurveyRow[]
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
* @return SurveyRow
*/
public function getRow() {
$dataRow = parent::getRow();
$row = $this->getModelRow($dataRow);
return $row;
}
/**
* @return SurveyRow
*/
public function getRowById($id) {
return parent::getRowById($id);
}
private function getModelRow($dataRow) {
$row = new SurveyRow($dataRow, $this->model);
$row->model = $this->model;
return $row;
}
}