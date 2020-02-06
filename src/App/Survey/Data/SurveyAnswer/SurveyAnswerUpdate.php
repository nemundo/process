<?php
namespace Nemundo\Process\App\Survey\Data\SurveyAnswer;
use Nemundo\Model\Data\AbstractModelUpdate;
class SurveyAnswerUpdate extends AbstractModelUpdate {
/**
* @var SurveyAnswerModel
*/
public $model;

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
public function update() {
$this->typeValueList->setModelValue($this->model->surveyId, $this->surveyId);
$this->typeValueList->setModelValue($this->model->answer, $this->answer);
parent::update();
}
}