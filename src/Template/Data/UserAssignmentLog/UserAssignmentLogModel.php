<?php
namespace Nemundo\Process\Template\Data\UserAssignmentLog;
class UserAssignmentLogModel extends \Nemundo\Model\Definition\Model\AbstractModel {
/**
* @var \Nemundo\Model\Type\Id\IdType
*/
public $id;

/**
* @var \Nemundo\Model\Type\External\Id\ExternalUniqueIdType
*/
public $userId;

/**
* @var \Nemundo\User\Data\User\UserExternalType
*/
public $user;

protected function loadModel() {
$this->tableName = "template_user_assignment_log";
$this->aliasTableName = "template_user_assignment_log";
$this->label = "User Assignment Log";

$this->primaryIndex = new \Nemundo\Db\Index\TextIdPrimaryIndex();

$this->id = new \Nemundo\Model\Type\Id\IdType($this);
$this->id->tableName = "template_user_assignment_log";
$this->id->fieldName = "id";
$this->id->aliasFieldName = "template_user_assignment_log_id";
$this->id->label = "Id";
$this->id->allowNullValue = false;
$this->id->visible->form = false;
$this->id->visible->table = false;
$this->id->visible->view = false;
$this->id->visible->form = false;

$this->userId = new \Nemundo\Model\Type\External\Id\ExternalUniqueIdType($this);
$this->userId->tableName = "template_user_assignment_log";
$this->userId->fieldName = "user";
$this->userId->aliasFieldName = "template_user_assignment_log_user";
$this->userId->label = "User";
$this->userId->allowNullValue = false;

}
public function loadUser() {
if ($this->user == null) {
$this->user = new \Nemundo\User\Data\User\UserExternalType($this, "template_user_assignment_log_user");
$this->user->tableName = "template_user_assignment_log";
$this->user->fieldName = "user";
$this->user->aliasFieldName = "template_user_assignment_log_user";
$this->user->label = "User";
}
return $this;
}
}