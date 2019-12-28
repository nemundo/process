<?php
namespace Nemundo\Process\App\Survey\Data\SurveyOption;
class SurveyOptionPaginationReader extends \Nemundo\Model\Reader\AbstractPaginationModelDataReader {
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
$list = [];
foreach (parent::getData() as $dataRow) {
$row = new SurveyOptionRow($dataRow, $this->model);
$list[] = $row;
}
return $list;
}
}