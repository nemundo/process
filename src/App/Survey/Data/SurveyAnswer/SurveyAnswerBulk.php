<?php
namespace Nemundo\Process\App\Survey\Data\SurveyAnswer;
class SurveyAnswerBulk extends \Nemundo\Model\Data\AbstractModelDataBulk {
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