<?php
namespace Nemundo\Process\App\Survey\Data\Survey;
class SurveyBulk extends \Nemundo\Model\Data\AbstractModelDataBulk {
/**
* @var SurveyModel
*/
protected $model;

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
public function save() {
$this->typeValueList->setModelValue($this->model->survey, $this->survey);
$this->typeValueList->setModelValue($this->model->question, $this->question);
$id = parent::save();
return $id;
}
}