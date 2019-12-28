<?php
namespace Nemundo\Process\App\Survey\Data\Survey;
class Survey extends \Nemundo\Model\Data\AbstractModelData {
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

public function __construct() {
parent::__construct();
$this->model = new SurveyModel();
}
public function save() {
$id = $this->id;
$this->typeValueList->setModelValue($this->model->id, $id);
$this->typeValueList->setModelValue($this->model->name, $this->name);
$this->typeValueList->setModelValue($this->model->vorname, $this->vorname);
$id = parent::save();
return $id;
}
}