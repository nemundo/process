<?php
namespace Nemundo\Process\Template\Data\UserAssignmentLog;
class UserAssignmentLogDelete extends \Nemundo\Model\Delete\AbstractModelDelete {
/**
* @var UserAssignmentLogModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new UserAssignmentLogModel();
}
}