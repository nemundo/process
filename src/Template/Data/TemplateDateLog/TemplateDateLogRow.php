<?php
namespace Nemundo\Process\Template\Data\TemplateDateLog;
class TemplateDateLogRow extends \Nemundo\Model\Row\AbstractModelDataRow {
/**
* @var \Nemundo\Model\Row\AbstractModelDataRow
*/
private $row;

/**
* @var TemplateDateLogModel
*/
public $model;

/**
* @var string
*/
public $id;

/**
* @var \Nemundo\Core\Type\DateTime\Date
*/
public $dateFrom;

/**
* @var \Nemundo\Core\Type\DateTime\Date
*/
public $dateTo;

public function __construct(\Nemundo\Db\Row\AbstractDataRow $row, $model) {
parent::__construct($row->getData());
$this->row = $row;
$this->id = $this->getModelValue($model->id);
$value = $this->getModelValue($model->dateFrom);
if ($value !== "0000-00-00") {
$this->dateFrom = new \Nemundo\Core\Type\DateTime\Date($this->getModelValue($model->dateFrom));
}
$value = $this->getModelValue($model->dateTo);
if ($value !== "0000-00-00") {
$this->dateTo = new \Nemundo\Core\Type\DateTime\Date($this->getModelValue($model->dateTo));
}
}
}