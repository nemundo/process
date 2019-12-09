<?php
namespace Nemundo\Process\Template\Data\DeadlineChange;
class DeadlineChangeValue extends \Nemundo\Model\Value\AbstractModelDataValue {
/**
* @var DeadlineChangeModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new DeadlineChangeModel();
}
}