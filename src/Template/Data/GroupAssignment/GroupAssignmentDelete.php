<?php
namespace Nemundo\Process\Template\Data\GroupAssignment;
class GroupAssignmentDelete extends \Nemundo\Model\Delete\AbstractModelDelete {
/**
* @var GroupAssignmentModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new GroupAssignmentModel();
}
}