<?php
namespace Nemundo\Process\Data\Process;
class ProcessBulk extends \Nemundo\Model\Data\AbstractModelDataBulk {
/**
* @var ProcessModel
*/
protected $model;

/**
* @var string
*/
public $id;

/**
* @var string
*/
public $process;

public function __construct() {
parent::__construct();
$this->model = new ProcessModel();
}
public function save() {
$id = $this->id;
$this->typeValueList->setModelValue($this->model->id, $id);
$this->typeValueList->setModelValue($this->model->process, $this->process);
$id = parent::save();
return $id;
}
}