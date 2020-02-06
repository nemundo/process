<?php
namespace Nemundo\Process\App\Survey\Data;
use Nemundo\Model\Collection\AbstractModelCollection;
class SurveyCollection extends AbstractModelCollection {
protected function loadCollection() {
$this->addModel(new \Nemundo\Process\App\Survey\Data\Survey\SurveyModel());
$this->addModel(new \Nemundo\Process\App\Survey\Data\SurveyAnswer\SurveyAnswerModel());
}
}