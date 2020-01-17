<?php
namespace Nemundo\Process\App\Assignment\Data\AssignmentStatus;
class AssignmentStatusValue extends \Nemundo\Model\Value\AbstractModelDataValue {
/**
* @var AssignmentStatusModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new AssignmentStatusModel();
}
}