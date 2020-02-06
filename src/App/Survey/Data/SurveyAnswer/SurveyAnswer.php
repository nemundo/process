<?php
namespace Nemundo\Process\App\Survey\Data\SurveyAnswer;
class SurveyAnswer extends \Nemundo\Model\Data\AbstractModelData {
/**
* @var SurveyAnswerModel
*/
protected $model;

/**
* @var string
*/
public $surveyId;

/**
* @var string
*/
public $answer;

public function __construct() {
parent::__construct();
$this->model = new SurveyAnswerModel();
}
public function save() {
$this->typeValueList->setModelValue($this->model->surveyId, $this->surveyId);
$this->typeValueList->setModelValue($this->model->answer, $this->answer);
$id = parent::save();
return $id;
}
}