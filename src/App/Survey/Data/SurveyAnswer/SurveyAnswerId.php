<?php
namespace Nemundo\Process\App\Survey\Data\SurveyAnswer;
use Nemundo\Model\Id\AbstractModelIdValue;
class SurveyAnswerId extends AbstractModelIdValue {
/**
* @var SurveyAnswerModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new SurveyAnswerModel();
}
}