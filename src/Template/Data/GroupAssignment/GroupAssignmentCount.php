<?php
namespace Nemundo\Process\Template\Data\GroupAssignment;
class GroupAssignmentCount extends \Nemundo\Model\Count\AbstractModelDataCount {
/**
* @var GroupAssignmentModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new GroupAssignmentModel();
}
}