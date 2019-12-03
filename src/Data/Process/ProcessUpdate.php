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

public function __construct() {
parent::__construct();
$this->model = new ProcessModel();
}
public function update() {
$this->typeValueList->setModelValue($this->model->process, $this->process);
parent::update();
}
}