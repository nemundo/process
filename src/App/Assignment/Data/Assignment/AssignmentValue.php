<?php
namespace Nemundo\Process\App\Assignment\Data\Assignment;
class AssignmentValue extends \Nemundo\Model\Value\AbstractModelDataValue {
/**
* @var AssignmentModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new AssignmentModel();
}
}