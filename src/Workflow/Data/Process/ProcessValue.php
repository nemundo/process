<?php
namespace Nemundo\Process\Workflow\Data\Process;
class ProcessValue extends \Nemundo\Model\Value\AbstractModelDataValue {
/**
* @var ProcessModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new ProcessModel();
}
}