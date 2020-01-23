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
public $id;

/**
* @var string
*/
public $name;

/**
* @var string
*/
public $vorname;

/**
* @var string
*/
public $beschreibung;

public function __construct() {
parent::__construct();
$this->model = new SurveyModel();
}
public function save() {
$id = $this->id;
$this->typeValueList->setModelValue($this->model->id, $id);
$this->typeValueList->setModelValue($this->model->name, $this->name);
$this->typeValueList->setModelValue($this->model->vorname, $this->vorname);
$this->typeValueList->setModelValue($this->model->beschreibung, $this->beschreibung);
$id = parent::save();
return $id;
}
}