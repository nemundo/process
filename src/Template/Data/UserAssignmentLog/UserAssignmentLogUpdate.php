<?php
namespace Nemundo\Process\Template\Data\UserAssignmentLog;
use Nemundo\Model\Data\AbstractModelUpdate;
class UserAssignmentLogUpdate extends AbstractModelUpdate {
/**
* @var UserAssignmentLogModel
*/
public $model;

/**
* @var string
*/
public $userId;

public function __construct() {
parent::__construct();
$this->model = new UserAssignmentLogModel();
}
public function update() {
$this->typeValueList->setModelValue($this->model->userId, $this->userId);
parent::update();
}
}