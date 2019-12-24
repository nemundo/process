<?php
namespace Nemundo\Process\Group\Data\GroupUser;
class GroupUserModel extends \Nemundo\Model\Definition\Model\AbstractModel {
/**
* @var \Nemundo\Model\Type\Id\IdType
*/
public $id;

/**
* @var \Nemundo\Model\Type\External\Id\ExternalUniqueIdType
*/
public $groupId;

/**
* @var \Nemundo\Process\Group\Data\Group\GroupExternalType
*/
public $group;

/**
* @var \Nemundo\Model\Type\External\Id\ExternalUniqueIdType
*/
public $userId;

/**
* @var \Nemundo\User\Data\User\UserExternalType
*/
public $user;

protected function loadModel() {
$this->tableName = "group_group_user";
$this->aliasTableName = "group_group_user";
$this->label = "Group User";

$this->primaryIndex = new \Nemundo\Db\Index\AutoIncrementIdPrimaryIndex();

$this->id = new \Nemundo\Model\Type\Id\IdType($this);
$this->id->tableName = "group_group_user";
$this->id->fieldName = "id";
$this->id->aliasFieldName = "group_group_user_id";
$this->id->label = "Id";
$this->id->allowNullValue = false;
$this->id->visible->form = false;
$this->id->visible->table = false;
$this->id->visible->view = false;
$this->id->visible->form = false;

$this->groupId = new \Nemundo\Model\Type\External\Id\ExternalUniqueIdType($this);
$this->groupId->tableName = "group_group_user";
$this->groupId->fieldName = "group";
$this->groupId->aliasFieldName = "group_group_user_group";
$this->groupId->label = "Group";
$this->groupId->allowNullValue = false;

$this->userId = new \Nemundo\Model\Type\External\Id\ExternalUniqueIdType($this);
$this->userId->tableName = "group_group_user";
$this->userId->fieldName = "user";
$this->userId->aliasFieldName = "group_group_user_user";
$this->userId->label = "User";
$this->userId->allowNullValue = false;

$index = new \Nemundo\Model\Definition\Index\ModelUniqueIndex($this);
$index->indexName = "group_user";
$index->addType($this->groupId);
$index->addType($this->userId);

}
public function loadGroup() {
if ($this->group == null) {
$this->group = new \Nemundo\Process\Group\Data\Group\GroupExternalType($this, "group_group_user_group");
$this->group->tableName = "group_group_user";
$this->group->fieldName = "group";
$this->group->aliasFieldName = "group_group_user_group";
$this->group->label = "Group";
}
return $this;
}
public function loadUser() {
if ($this->user == null) {
$this->user = new \Nemundo\User\Data\User\UserExternalType($this, "group_group_user_user");
$this->user->tableName = "group_group_user";
$this->user->fieldName = "user";
$this->user->aliasFieldName = "group_group_user_user";
$this->user->label = "User";
}
return $this;
}
}