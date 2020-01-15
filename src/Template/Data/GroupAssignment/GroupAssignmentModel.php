<?php
namespace Nemundo\Process\Template\Data\GroupAssignment;
class GroupAssignmentModel extends \Nemundo\Model\Definition\Model\AbstractModel {
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
* @var \Nemundo\Model\Type\DateTime\DateType
*/
public $deadline;

protected function loadModel() {
$this->tableName = "template_group_assignment";
$this->aliasTableName = "template_group_assignment";
$this->label = "Group Assignment";

$this->primaryIndex = new \Nemundo\Db\Index\UniqueIdPrimaryIndex();

$this->id = new \Nemundo\Model\Type\Id\IdType($this);
$this->id->tableName = "template_group_assignment";
$this->id->fieldName = "id";
$this->id->aliasFieldName = "template_group_assignment_id";
$this->id->label = "Id";
$this->id->allowNullValue = false;
$this->id->visible->form = false;
$this->id->visible->table = false;
$this->id->visible->view = false;
$this->id->visible->form = false;

$this->groupId = new \Nemundo\Model\Type\External\Id\ExternalUniqueIdType($this);
$this->groupId->tableName = "template_group_assignment";
$this->groupId->fieldName = "group";
$this->groupId->aliasFieldName = "template_group_assignment_group";
$this->groupId->label = "Group";
$this->groupId->allowNullValue = false;

$this->deadline = new \Nemundo\Model\Type\DateTime\DateType($this);
$this->deadline->tableName = "template_group_assignment";
$this->deadline->fieldName = "deadline";
$this->deadline->aliasFieldName = "template_group_assignment_deadline";
$this->deadline->label = "Deadline";
$this->deadline->allowNullValue = false;

}
public function loadGroup() {
if ($this->group == null) {
$this->group = new \Nemundo\Process\Group\Data\Group\GroupExternalType($this, "template_group_assignment_group");
$this->group->tableName = "template_group_assignment";
$this->group->fieldName = "group";
$this->group->aliasFieldName = "template_group_assignment_group";
$this->group->label = "Group";
}
return $this;
}
}