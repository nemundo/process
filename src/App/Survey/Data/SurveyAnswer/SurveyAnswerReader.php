<?php
namespace Nemundo\Process\App\Survey\Data\SurveyAnswer;
class SurveyAnswerReader extends \Nemundo\Model\Reader\ModelDataReader {
/**
* @var SurveyAnswerModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new SurveyAnswerModel();
}
/**
* @return SurveyAnswerRow[]
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
* @return SurveyAnswerRow
*/
public function getRow() {
$dataRow = parent::getRow();
$row = $this->getModelRow($dataRow);
return $row;
}
/**
* @return SurveyAnswerRow
*/
public function getRowById($id) {
return parent::getRowById($id);
}
private function getModelRow($dataRow) {
$row = new SurveyAnswerRow($dataRow, $this->model);
$row->model = $this->model;
return $row;
}
}