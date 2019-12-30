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
public $name;

/**
* @var \Nemundo\Model\Type\Text\TextType
*/
public $vorname;

/**
* @var \Nemundo\Model\Type\Text\LargeTextType
*/
public $beschreibung;

protected function loadModel() {
$this->tableName = "survey_survey";
$this->aliasTableName = "survey_survey";
$this->label = "Survey";

$this->primaryIndex = new \Nemundo\Db\Index\TextIdPrimaryIndex();

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

$this->name = new \Nemundo\Model\Type\Text\TextType($this);
$this->name->tableName = "survey_survey";
$this->name->fieldName = "name";
$this->name->aliasFieldName = "survey_survey_name";
$this->name->label = "Name";
$this->name->allowNullValue = false;
$this->name->length = 255;

$this->vorname = new \Nemundo\Model\Type\Text\TextType($this);
$this->vorname->tableName = "survey_survey";
$this->vorname->fieldName = "vorname";
$this->vorname->aliasFieldName = "survey_survey_vorname";
$this->vorname->label = "Vorname";
$this->vorname->allowNullValue = false;
$this->vorname->length = 255;

$this->beschreibung = new \Nemundo\Model\Type\Text\LargeTextType($this);
$this->beschreibung->tableName = "survey_survey";
$this->beschreibung->fieldName = "beschreibung";
$this->beschreibung->aliasFieldName = "survey_survey_beschreibung";
$this->beschreibung->label = "Beschreibung";
$this->beschreibung->allowNullValue = false;

}
}