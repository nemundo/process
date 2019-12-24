<?php
namespace Nemundo\Process\Group\Data\GroupUser;
class GroupUserBulk extends \Nemundo\Model\Data\AbstractModelDataBulk {
/**
* @var GroupUserModel
*/
protected $model;

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
public function save() {
$this->typeValueList->setModelValue($this->model->groupId, $this->groupId);
$this->typeValueList->setModelValue($this->model->userId, $this->userId);
$id = parent::save();
return $id;
}
}