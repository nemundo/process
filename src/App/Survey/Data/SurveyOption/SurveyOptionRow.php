<?php
namespace Nemundo\Process\App\Survey\Data\SurveyOption;
class SurveyOptionRow extends \Nemundo\Model\Row\AbstractModelDataRow {
/**
* @var \Nemundo\Model\Row\AbstractModelDataRow
*/
private $row;

/**
* @var SurveyOptionModel
*/
public $model;

/**
* @var string
*/
public $id;

/**
* @var string
*/
public $surveyId;

/**
* @var \Nemundo\Process\App\Survey\Data\Survey\SurveyRow
*/
public $survey;

/**
* @var string
*/
public $optionText;

public function __construct(\Nemundo\Db\Row\AbstractDataRow $row, $model) {
parent::__construct($row->getData());
$this->row = $row;
$this->id = $this->getModelValue($model->id);
$this->surveyId = $this->getModelValue($model->surveyId);
if ($model->survey !== null) {
$this->loadNemundoProcessAppSurveyDataSurveySurveysurveyRow($model->survey);
}
$this->optionText = $this->getModelValue($model->optionText);
}
private function loadNemundoProcessAppSurveyDataSurveySurveysurveyRow($model) {
$this->survey = new \Nemundo\Process\App\Survey\Data\Survey\SurveyRow($this->row, $model);
}
}