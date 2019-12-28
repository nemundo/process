<?php
namespace Nemundo\Process\App\Survey\Data\SurveyOption;
use Nemundo\Model\Id\AbstractModelIdValue;
class SurveyOptionId extends AbstractModelIdValue {
/**
* @var SurveyOptionModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new SurveyOptionModel();
}
}