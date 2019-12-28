<?php
namespace Nemundo\Process\App\Survey\Data\Survey;
class SurveyCount extends \Nemundo\Model\Count\AbstractModelDataCount {
/**
* @var SurveyModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new SurveyModel();
}
}