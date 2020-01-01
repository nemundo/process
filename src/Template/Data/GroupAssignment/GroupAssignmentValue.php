<?php
namespace Nemundo\Process\Template\Data\GroupAssignment;
class GroupAssignmentValue extends \Nemundo\Model\Value\AbstractModelDataValue {
/**
* @var GroupAssignmentModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new GroupAssignmentModel();
}
}