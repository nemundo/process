<?php
namespace Nemundo\Process\Template\Data\GroupAssignment;
class GroupAssignment extends \Nemundo\Model\Data\AbstractModelData {
/**
* @var GroupAssignmentModel
*/
protected $model;

/**
* @var string
*/
public $id;

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
public function save() {
$id = $this->id;
$this->typeValueList->setModelValue($this->model->id, $id);
$this->typeValueList->setModelValue($this->model->groupId, $this->groupId);
$property = new \Nemundo\Model\Data\Property\DateTime\DateDataProperty($this->model->deadline, $this->typeValueList);
$property->setValue($this->deadline);
$id = parent::save();
return $id;
}
}