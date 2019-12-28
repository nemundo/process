<?php
namespace Nemundo\Process\App\Survey\Data\SurveyOption;
class SurveyOptionDelete extends \Nemundo\Model\Delete\AbstractModelDelete {
/**
* @var SurveyOptionModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new SurveyOptionModel();
}
}