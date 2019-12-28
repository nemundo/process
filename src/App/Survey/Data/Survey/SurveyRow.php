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
public $name;

/**
* @var string
*/
public $vorname;

public function __construct(\Nemundo\Db\Row\AbstractDataRow $row, $model) {
parent::__construct($row->getData());
$this->row = $row;
$this->id = $this->getModelValue($model->id);
$this->name = $this->getModelValue($model->name);
$this->vorname = $this->getModelValue($model->vorname);
}
}