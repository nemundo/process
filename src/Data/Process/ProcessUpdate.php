<?php
namespace Nemundo\Process\Data\Process;
use Nemundo\Model\Data\AbstractModelUpdate;
class ProcessUpdate extends AbstractModelUpdate {
/**
* @var ProcessModel
*/
public $model;

/**
* @var string
*/
public $process;

/**
* @var string
*/
public $processClass;

public function __construct() {
parent::__construct();
$this->model = new ProcessModel();
}
public function update() {
$this->typeValueList->setModelValue($this->model->process, $this->process);
$this->typeValueList->setModelValue($this->model->processClass, $this->processClass);
parent::update();
}
}