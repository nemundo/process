<?php
namespace Nemundo\Process\App\Survey\Data\Survey;
use Nemundo\Model\Data\AbstractModelUpdate;
class SurveyUpdate extends AbstractModelUpdate {
/**
* @var SurveyModel
*/
public $model;

/**
* @var string
*/
public $survey;

/**
* @var string
*/
public $question;

public function __construct() {
parent::__construct();
$this->model = new SurveyModel();
}
public function update() {
$this->typeValueList->setModelValue($this->model->survey, $this->survey);
$this->typeValueList->setModelValue($this->model->question, $this->question);
parent::update();
}
}