<?php
namespace Nemundo\Process\Template\Data\TemplateNumber;
class TemplateNumberRow extends \Nemundo\Model\Row\AbstractModelDataRow {
/**
* @var \Nemundo\Model\Row\AbstractModelDataRow
*/
private $row;

/**
* @var TemplateNumberModel
*/
public $model;

/**
* @var string
*/
public $id;

/**
* @var int
*/
public $number;

public function __construct(\Nemundo\Db\Row\AbstractDataRow $row, $model) {
parent::__construct($row->getData());
$this->row = $row;
$this->id = $this->getModelValue($model->id);
$this->number = intval($this->getModelValue($model->number));
}
}