<?php
namespace Nemundo\Process\Data\Status;
class StatusBulk extends \Nemundo\Model\Data\AbstractModelDataBulk {
/**
* @var StatusModel
*/
protected $model;

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

public function __construct() {
parent::__construct();
$this->model = new StatusModel();
}
public function save() {
$id = $this->id;
$this->typeValueList->setModelValue($this->model->id, $id);
$this->typeValueList->setModelValue($this->model->statusLabel, $this->statusLabel);
$this->typeValueList->setModelValue($this->model->statusClass, $this->statusClass);
$id = parent::save();
return $id;
}
}