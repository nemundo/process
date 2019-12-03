<?php
namespace Nemundo\Process\Data\Status;
class Status extends \Nemundo\Model\Data\AbstractModelData {
/**
* @var StatusModel
*/
protected $model;

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
$this->typeValueList->setModelValue($this->model->statusLabel, $this->statusLabel);
$this->typeValueList->setModelValue($this->model->statusClass, $this->statusClass);
$id = parent::save();
return $id;
}
}