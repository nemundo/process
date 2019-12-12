<?php
namespace Nemundo\Process\Template\Data\UserAssignmentLog;
class UserAssignmentLogValue extends \Nemundo\Model\Value\AbstractModelDataValue {
/**
* @var UserAssignmentLogModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new UserAssignmentLogModel();
}
}