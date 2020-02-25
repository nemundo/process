<?php
namespace Nemundo\Process\App\Assignment\Data\AssignmentLog;
class AssignmentLogValue extends \Nemundo\Model\Value\AbstractModelDataValue {
/**
* @var AssignmentLogModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new AssignmentLogModel();
}
}