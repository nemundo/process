<?php
namespace Nemundo\Process\Data\Process;
class ProcessRow extends \Nemundo\Model\Row\AbstractModelDataRow {
/**
* @var \Nemundo\Model\Row\AbstractModelDataRow
*/
private $row;

/**
* @var ProcessModel
*/
public $model;

/**
* @var string
*/
public $id;

/**
* @var string
*/
public $process;

public function __construct(\Nemundo\Db\Row\AbstractDataRow $row, $model) {
parent::__construct($row->getData());
$this->row = $row;
$this->id = $this->getModelValue($model->id);
$this->process = $this->getModelValue($model->process);
}
}