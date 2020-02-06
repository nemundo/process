<?php
namespace Nemundo\Process\App\Survey\Data\SurveyAnswer;
class SurveyAnswerValue extends \Nemundo\Model\Value\AbstractModelDataValue {
/**
* @var SurveyAnswerModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new SurveyAnswerModel();
}
}