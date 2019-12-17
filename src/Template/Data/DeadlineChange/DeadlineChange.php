<?php
namespace Nemundo\Process\Template\Data\DeadlineChange;
class DeadlineChange extends \Nemundo\Model\Data\AbstractModelData {
/**
* @var DeadlineChangeModel
*/
protected $model;

/**
* @var string
*/
public $id;

/**
* @var \Nemundo\Core\Type\DateTime\Date
*/
public $deadline;

public function __construct() {
parent::__construct();
$this->model = new DeadlineChangeModel();
$this->deadline = new \Nemundo\Core\Type\DateTime\Date();
}
public function save() {
$id = $this->id;
$this->typeValueList->setModelValue($this->model->id, $id);
$property = new \Nemundo\Model\Data\Property\DateTime\DateDataProperty($this->model->deadline, $this->typeValueList);
$property->setValue($this->deadline);
$id = parent::save();
return $id;
}
}