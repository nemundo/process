<?php
namespace Nemundo\Process\App\Survey\Data\Survey;
class SurveyExternalType extends \Nemundo\Model\Type\External\ExternalType {
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

protected function loadExternalType() {
parent::loadExternalType();
$this->externalModelClassName = SurveyModel::class;
$this->externalTableName = "survey_survey";
$this->aliasTableName = $this->parentFieldName . "_" . $this->externalTableName;
$this->id = new \Nemundo\Model\Type\Id\IdType();
$this->id->fieldName = "id";
$this->id->tableName = $this->parentFieldName . "_" . $this->externalTableName;
$this->id->aliasFieldName = $this->id->tableName . "_" . $this->id->fieldName;
$this->id->label = "Id";
$this->addType($this->id);

$this->survey = new \Nemundo\Model\Type\Text\TextType();
$this->survey->fieldName = "survey";
$this->survey->tableName = $this->parentFieldName . "_" . $this->externalTableName;
$this->survey->aliasFieldName = $this->survey->tableName . "_" . $this->survey->fieldName;
$this->survey->label = "Survey";
$this->addType($this->survey);

$this->question = new \Nemundo\Model\Type\Text\LargeTextType();
$this->question->fieldName = "question";
$this->question->tableName = $this->parentFieldName . "_" . $this->externalTableName;
$this->question->aliasFieldName = $this->question->tableName . "_" . $this->question->fieldName;
$this->question->label = "Question";
$this->addType($this->question);

}
}