<?php
namespace Nemundo\Process\App\Survey\Data\SurveyOption;
class SurveyOptionCount extends \Nemundo\Model\Count\AbstractModelDataCount {
/**
* @var SurveyOptionModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new SurveyOptionModel();
}
}