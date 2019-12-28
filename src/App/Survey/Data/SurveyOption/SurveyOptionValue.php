<?php
namespace Nemundo\Process\App\Survey\Data\SurveyOption;
class SurveyOptionValue extends \Nemundo\Model\Value\AbstractModelDataValue {
/**
* @var SurveyOptionModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new SurveyOptionModel();
}
}