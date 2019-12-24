<?php
namespace Nemundo\Process\Group\Data\GroupUser;
use Nemundo\Model\Data\AbstractModelUpdate;
class GroupUserUpdate extends AbstractModelUpdate {
/**
* @var GroupUserModel
*/
public $model;

/**
* @var string
*/
public $groupId;

/**
* @var string
*/
public $userId;

public function __construct() {
parent::__construct();
$this->model = new GroupUserModel();
}
public function update() {
$this->typeValueList->setModelValue($this->model->groupId, $this->groupId);
$this->typeValueList->setModelValue($this->model->userId, $this->userId);
parent::update();
}
}