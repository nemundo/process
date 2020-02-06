<?php
namespace Nemundo\Process\App\Survey\Data\SurveyAnswer;
class SurveyAnswerModel extends \Nemundo\Model\Definition\Model\AbstractModel {
/**
* @var \Nemundo\Model\Type\Id\IdType
*/
public $id;

/**
* @var \Nemundo\Model\Type\External\Id\ExternalIdType
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

protected function loadModel() {
$this->tableName = "survey_survey_answer";
$this->aliasTableName = "survey_survey_answer";
$this->label = "Survey Answer";

$this->primaryIndex = new \Nemundo\Db\Index\AutoIncrementIdPrimaryIndex();

$this->id = new \Nemundo\Model\Type\Id\IdType($this);
$this->id->tableName = "survey_survey_answer";
$this->id->fieldName = "id";
$this->id->aliasFieldName = "survey_survey_answer_id";
$this->id->label = "Id";
$this->id->allowNullValue = false;
$this->id->visible->form = false;
$this->id->visible->table = false;
$this->id->visible->view = false;
$this->id->visible->form = false;

$this->surveyId = new \Nemundo\Model\Type\External\Id\ExternalIdType($this);
$this->surveyId->tableName = "survey_survey_answer";
$this->surveyId->fieldName = "survey";
$this->surveyId->aliasFieldName = "survey_survey_answer_survey";
$this->surveyId->label = "Survey";
$this->surveyId->allowNullValue = false;

$this->answer = new \Nemundo\Model\Type\Text\TextType($this);
$this->answer->tableName = "survey_survey_answer";
$this->answer->fieldName = "answer";
$this->answer->aliasFieldName = "survey_survey_answer_answer";
$this->answer->label = "Answer";
$this->answer->allowNullValue = false;
$this->answer->length = 255;

$index = new \Nemundo\Model\Definition\Index\ModelIndex($this);
$index->indexName = "survey";
$index->addType($this->surveyId);

}
public function loadSurvey() {
if ($this->survey == null) {
$this->survey = new \Nemundo\Process\App\Survey\Data\Survey\SurveyExternalType($this, "survey_survey_answer_survey");
$this->survey->tableName = "survey_survey_answer";
$this->survey->fieldName = "survey";
$this->survey->aliasFieldName = "survey_survey_answer_survey";
$this->survey->label = "Survey";
}
return $this;
}
}