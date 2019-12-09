<?php
namespace Nemundo\Process\Template\Data\DeadlineChange;
use Nemundo\Model\Data\AbstractModelUpdate;
class DeadlineChangeUpdate extends AbstractModelUpdate {
/**
* @var DeadlineChangeModel
*/
public $model;

/**
* @var \Nemundo\Core\Type\DateTime\Date
*/
public $deadline;

public function __construct() {
parent::__construct();
$this->model = new DeadlineChangeModel();
$this->deadline = new \Nemundo\Core\Type\DateTime\Date();
}
public function update() {
$property = new \Nemundo\Model\Data\Property\DateTime\DateDataProperty($this->model->deadline, $this->typeValueList);
$property->setValue($this->deadline);
parent::update();
}
}