<?php
namespace Nemundo\Process\App\Survey\Data\Survey;
use Nemundo\Model\Data\AbstractModelUpdate;
class SurveyUpdate extends AbstractModelUpdate {
/**
* @var SurveyModel
*/
public $model;

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
public function update() {
$this->typeValueList->setModelValue($this->model->name, $this->name);
$this->typeValueList->setModelValue($this->model->vorname, $this->vorname);
$this->typeValueList->setModelValue($this->model->beschreibung, $this->beschreibung);
parent::update();
}
}