<?php
namespace Nemundo\Process\Data\Status;
class StatusRow extends \Nemundo\Model\Row\AbstractModelDataRow {
/**
* @var \Nemundo\Model\Row\AbstractModelDataRow
*/
private $row;

/**
* @var StatusModel
*/
public $model;

/**
* @var string
*/
public $id;

/**
* @var string
*/
public $statusLabel;

/**
* @var string
*/
public $statusClass;

public function __construct(\Nemundo\Db\Row\AbstractDataRow $row, $model) {
parent::__construct($row->getData());
$this->row = $row;
$this->id = $this->getModelValue($model->id);
$this->statusLabel = $this->getModelValue($model->statusLabel);
$this->statusClass = $this->getModelValue($model->statusClass);
}
}