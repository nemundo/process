<?php
namespace Nemundo\Process\App\Survey\Data\Survey;
class SurveyModel extends \Nemundo\Model\Definition\Model\AbstractModel {
/**
* @var \Nemundo\Model\Type\Id\IdType
*/
public $id;

/**
* @var \Nemundo\Model\Type\Text\TextType
*/
public $survey;

/**
* @var \Nemundo\Model\Type\Text\LargeTextType
*/
public $question;

protected function loadModel() {
$this->tableName = "survey_survey";
$this->aliasTableName = "survey_survey";
$this->label = "Survey";

$this->primaryIndex = new \Nemundo\Db\Index\AutoIncrementIdPrimaryIndex();

$this->id = new \Nemundo\Model\Type\Id\IdType($this);
$this->id->tableName = "survey_survey";
$this->id->fieldName = "id";
$this->id->aliasFieldName = "survey_survey_id";
$this->id->label = "Id";
$this->id->allowNullValue = false;
$this->id->visible->form = false;
$this->id->visible->table = false;
$this->id->visible->view = false;
$this->id->visible->form = false;

$this->survey = new \Nemundo\Model\Type\Text\TextType($this);
$this->survey->tableName = "survey_survey";
$this->survey->fieldName = "survey";
$this->survey->aliasFieldName = "survey_survey_survey";
$this->survey->label = "Survey";
$this->survey->allowNullValue = false;
$this->survey->length = 255;

$this->question = new \Nemundo\Model\Type\Text\LargeTextType($this);
$this->question->tableName = "survey_survey";
$this->question->fieldName = "question";
$this->question->aliasFieldName = "survey_survey_question";
$this->question->label = "Question";
$this->question->allowNullValue = false;

}
}