<?php
namespace Nemundo\Process\App\Survey\Data\Survey;
class SurveyValue extends \Nemundo\Model\Value\AbstractModelDataValue {
/**
* @var SurveyModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new SurveyModel();
}
}