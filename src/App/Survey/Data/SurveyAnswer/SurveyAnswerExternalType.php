<?php
namespace Nemundo\Process\App\Survey\Data\SurveyAnswer;
class SurveyAnswerExternalType extends \Nemundo\Model\Type\External\ExternalType {
/**
* @var \Nemundo\Model\Type\Id\IdType
*/
public $id;

/**
* @var \Nemundo\Model\Type\Id\IdType
*/
public $surveyId;

/**
* @var \Nemundo\Process\App\Survey\Data\Survey\SurveyExternalType
*/
public $survey;

/**
* @var \Nemundo\Model\Type\Text\TextType
*/
public $answer;

protected function loadExternalType() {
parent::loadExternalType();
$this->externalModelClassName = SurveyAnswerModel::class;
$this->externalTableName = "survey_survey_answer";
$this->aliasTableName = $this->parentFieldName . "_" . $this->externalTableName;
$this->id = new \Nemundo\Model\Type\Id\IdType();
$this->id->fieldName = "id";
$this->id->tableName = $this->parentFieldName . "_" . $this->externalTableName;
$this->id->aliasFieldName = $this->id->tableName . "_" . $this->id->fieldName;
$this->id->label = "Id";
$this->addType($this->id);

$this->surveyId = new \Nemundo\Model\Type\Id\IdType();
$this->surveyId->fieldName = "survey";
$this->surveyId->tableName = $this->parentFieldName . "_" . $this->externalTableName;
$this->surveyId->aliasFieldName = $this->surveyId->tableName ."_".$this->surveyId->fieldName;
$this->surveyId->label = "Survey";
$this->addType($this->surveyId);

$this->answer = new \Nemundo\Model\Type\Text\TextType();
$this->answer->fieldName = "answer";
$this->answer->tableName = $this->parentFieldName . "_" . $this->externalTableName;
$this->answer->aliasFieldName = $this->answer->tableName . "_" . $this->answer->fieldName;
$this->answer->label = "Answer";
$this->addType($this->answer);

}
public function loadSurvey() {
if ($this->survey == null) {
$this->survey = new \Nemundo\Process\App\Survey\Data\Survey\SurveyExternalType(null, $this->parentFieldName . "_survey");
$this->survey->fieldName = "survey";
$this->survey->tableName = $this->parentFieldName . "_" . $this->externalTableName;
$this->survey->aliasFieldName = $this->survey->tableName ."_".$this->survey->fieldName;
$this->survey->label = "Survey";
$this->addType($this->survey);
}
return $this;
}
}