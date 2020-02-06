<?php
namespace Nemundo\Process\App\Survey\Data\Survey;
class SurveyRow extends \Nemundo\Model\Row\AbstractModelDataRow {
/**
* @var \Nemundo\Model\Row\AbstractModelDataRow
*/
private $row;

/**
* @var SurveyModel
*/
public $model;

/**
* @var string
*/
public $id;

/**
* @var string
*/
public $survey;

/**
* @var string
*/
public $question;

public function __construct(\Nemundo\Db\Row\AbstractDataRow $row, $model) {
parent::__construct($row->getData());
$this->row = $row;
$this->id = $this->getModelValue($model->id);
$this->survey = $this->getModelValue($model->survey);
$this->question = $this->getModelValue($model->question);
}
}