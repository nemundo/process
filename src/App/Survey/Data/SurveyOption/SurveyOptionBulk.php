<?php
namespace Nemundo\Process\App\Survey\Data\SurveyOption;
class SurveyOptionBulk extends \Nemundo\Model\Data\AbstractModelDataBulk {
/**
* @var SurveyOptionModel
*/
protected $model;

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
public function save() {
$this->typeValueList->setModelValue($this->model->surveyId, $this->surveyId);
$this->typeValueList->setModelValue($this->model->optionText, $this->optionText);
$id = parent::save();
return $id;
}
}