<?php
namespace Nemundo\Process\App\Survey\Data\Survey;
class SurveyDelete extends \Nemundo\Model\Delete\AbstractModelDelete {
/**
* @var SurveyModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new SurveyModel();
}
}