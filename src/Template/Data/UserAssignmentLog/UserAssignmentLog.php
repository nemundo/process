<?php
namespace Nemundo\Process\Template\Data\UserAssignmentLog;
class UserAssignmentLog extends \Nemundo\Model\Data\AbstractModelData {
/**
* @var UserAssignmentLogModel
*/
protected $model;

/**
* @var string
*/
public $userId;

public function __construct() {
parent::__construct();
$this->model = new UserAssignmentLogModel();
}
public function save() {
$this->typeValueList->setModelValue($this->model->userId, $this->userId);
$id = parent::save();
return $id;
}
}