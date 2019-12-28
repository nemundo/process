<?php
namespace Nemundo\Process\App\Survey\Data\SurveyOption;
class SurveyOptionExternalType extends \Nemundo\Model\Type\External\ExternalType {
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
public $optionText;

protected function loadExternalType() {
parent::loadExternalType();
$this->externalModelClassName = SurveyOptionModel::class;
$this->externalTableName = "survey_survey_option";
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

$this->optionText = new \Nemundo\Model\Type\Text\TextType();
$this->optionText->fieldName = "option_text";
$this->optionText->tableName = $this->parentFieldName . "_" . $this->externalTableName;
$this->optionText->aliasFieldName = $this->optionText->tableName . "_" . $this->optionText->fieldName;
$this->optionText->label = "Option Text";
$this->addType($this->optionText);

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