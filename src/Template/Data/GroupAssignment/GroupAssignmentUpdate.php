<?php
namespace Nemundo\Process\Template\Data\GroupAssignment;
use Nemundo\Model\Data\AbstractModelUpdate;
class GroupAssignmentUpdate extends AbstractModelUpdate {
/**
* @var GroupAssignmentModel
*/
public $model;

/**
* @var string
*/
public $groupId;

/**
* @var \Nemundo\Core\Type\DateTime\Date
*/
public $deadline;

public function __construct() {
parent::__construct();
$this->model = new GroupAssignmentModel();
$this->deadline = new \Nemundo\Core\Type\DateTime\Date();
}
public function update() {
$this->typeValueList->setModelValue($this->model->groupId, $this->groupId);
$property = new \Nemundo\Model\Data\Property\DateTime\DateDataProperty($this->model->deadline, $this->typeValueList);
$property->setValue($this->deadline);
parent::update();
}
}