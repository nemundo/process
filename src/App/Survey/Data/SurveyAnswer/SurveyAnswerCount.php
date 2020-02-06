<?php
namespace Nemundo\Process\App\Survey\Data\SurveyAnswer;
class SurveyAnswerCount extends \Nemundo\Model\Count\AbstractModelDataCount {
/**
* @var SurveyAnswerModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new SurveyAnswerModel();
}
}