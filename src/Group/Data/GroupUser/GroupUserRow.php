<?php
namespace Nemundo\Process\Group\Data\GroupUser;
class GroupUserRow extends \Nemundo\Model\Row\AbstractModelDataRow {
/**
* @var \Nemundo\Model\Row\AbstractModelDataRow
*/
private $row;

/**
* @var GroupUserModel
*/
public $model;

/**
* @var string
*/
public $id;

/**
* @var int
*/
public $groupId;

/**
* @var \Nemundo\Process\Group\Row\GroupCustomRow
*/
public $group;

/**
* @var string
*/
public $userId;

/**
* @var \Nemundo\User\Data\User\UserRow
*/
public $user;

public function __construct(\Nemundo\Db\Row\AbstractDataRow $row, $model) {
parent::__construct($row->getData());
$this->row = $row;
$this->id = $this->getModelValue($model->id);
$this->groupId = intval($this->getModelValue($model->groupId));
if ($model->group !== null) {
$this->loadNemundoProcessGroupDataGroupGroupgroupRow($model->group);
}
$this->userId = $this->getModelValue($model->userId);
if ($model->user !== null) {
$this->loadNemundoUserDataUserUseruserRow($model->user);
}
}
private function loadNemundoProcessGroupDataGroupGroupgroupRow($model) {
$this->group = new \Nemundo\Process\Group\Row\GroupCustomRow($this->row, $model);
}
private function loadNemundoUserDataUserUseruserRow($model) {
$this->user = new \Nemundo\User\Data\User\UserRow($this->row, $model);
}
}