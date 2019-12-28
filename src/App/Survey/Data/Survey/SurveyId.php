<?php
namespace Nemundo\Process\App\Survey\Data\Survey;
use Nemundo\Model\Id\AbstractModelIdValue;
class SurveyId extends AbstractModelIdValue {
/**
* @var SurveyModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new SurveyModel();
}
}