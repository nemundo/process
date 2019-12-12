<?php
namespace Nemundo\Process\Template\Data\UserAssignmentLog;
use Nemundo\Model\Id\AbstractModelIdValue;
class UserAssignmentLogId extends AbstractModelIdValue {
/**
* @var UserAssignmentLogModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new UserAssignmentLogModel();
}
}