<?php
namespace Nemundo\Process\App\Survey\Data\SurveyOption;
use Nemundo\Model\Data\AbstractModelUpdate;
class SurveyOptionUpdate extends AbstractModelUpdate {
/**
* @var SurveyOptionModel
*/
public $model;

/**
* @var string
*/
public $surveyId;

/**
* @var string
*/
public $optionText;

public function __construct() {
parent::__construct();
$this->model = new SurveyOptionModel();
}
public function update() {
$this->typeValueList->setModelValue($this->model->surveyId, $this->surveyId);
$this->typeValueList->setModelValue($this->model->optionText, $this->optionText);
parent::update();
}
}