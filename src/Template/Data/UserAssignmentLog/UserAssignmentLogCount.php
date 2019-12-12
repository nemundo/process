<?php
namespace Nemundo\Process\Template\Data\UserAssignmentLog;
class UserAssignmentLogCount extends \Nemundo\Model\Count\AbstractModelDataCount {
/**
* @var UserAssignmentLogModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new UserAssignmentLogModel();
}
}