<?php
namespace Nemundo\Process\Template\Data\GroupAssignment;
use Nemundo\Model\Id\AbstractModelIdValue;
class GroupAssignmentId extends AbstractModelIdValue {
/**
* @var GroupAssignmentModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new GroupAssignmentModel();
}
}