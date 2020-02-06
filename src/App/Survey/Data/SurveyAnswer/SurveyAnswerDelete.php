<?php
namespace Nemundo\Process\App\Survey\Data\SurveyAnswer;
class SurveyAnswerDelete extends \Nemundo\Model\Delete\AbstractModelDelete {
/**
* @var SurveyAnswerModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new SurveyAnswerModel();
}
}