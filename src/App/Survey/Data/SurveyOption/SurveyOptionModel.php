<?php
namespace Nemundo\Process\App\Survey\Data\SurveyOption;
class SurveyOptionModel extends \Nemundo\Model\Definition\Model\AbstractModel {
/**
* @var \Nemundo\Model\Type\Id\IdType
*/
public $id;

/**
* @var \Nemundo\Model\Type\External\Id\ExternalUniqueIdType
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

protected function loadModel() {
$this->tableName = "survey_survey_option";
$this->aliasTableName = "survey_survey_option";
$this->label = "Survey Option";

$this->primaryIndex = new \Nemundo\Db\Index\AutoIncrementIdPrimaryIndex();

$this->id = new \Nemundo\Model\Type\Id\IdType($this);
$this->id->tableName = "survey_survey_option";
$this->id->fieldName = "id";
$this->id->aliasFieldName = "survey_survey_option_id";
$this->id->label = "Id";
$this->id->allowNullValue = false;
$this->id->visible->form = false;
$this->id->visible->table = false;
$this->id->visible->view = false;
$this->id->visible->form = false;

$this->surveyId = new \Nemundo\Model\Type\External\Id\ExternalUniqueIdType($this);
$this->surveyId->tableName = "survey_survey_option";
$this->surveyId->fieldName = "survey";
$this->surveyId->aliasFieldName = "survey_survey_option_survey";
$this->surveyId->label = "Survey";
$this->surveyId->allowNullValue = false;

$this->optionText = new \Nemundo\Model\Type\Text\TextType($this);
$this->optionText->tableName = "survey_survey_option";
$this->optionText->fieldName = "option_text";
$this->optionText->aliasFieldName = "survey_survey_option_option_text";
$this->optionText->label = "Option Text";
$this->optionText->allowNullValue = false;
$this->optionText->length = 255;

}
public function loadSurvey() {
if ($this->survey == null) {
$this->survey = new \Nemundo\Process\App\Survey\Data\Survey\SurveyExternalType($this, "survey_survey_option_survey");
$this->survey->tableName = "survey_survey_option";
$this->survey->fieldName = "survey";
$this->survey->aliasFieldName = "survey_survey_option_survey";
$this->survey->label = "Survey";
}
return $this;
}
}