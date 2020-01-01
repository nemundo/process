<?php
namespace Nemundo\Process\Template\Data\GroupAssignment;
class GroupAssignmentExternalType extends \Nemundo\Model\Type\External\ExternalType {
/**
* @var \Nemundo\Model\Type\Id\IdType
*/
public $id;

/**
* @var \Nemundo\Model\Type\Id\IdType
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

protected function loadExternalType() {
parent::loadExternalType();
$this->externalModelClassName = GroupAssignmentModel::class;
$this->externalTableName = "template_group_assignment";
$this->aliasTableName = $this->parentFieldName . "_" . $this->externalTableName;
$this->id = new \Nemundo\Model\Type\Id\IdType();
$this->id->fieldName = "id";
$this->id->tableName = $this->parentFieldName . "_" . $this->externalTableName;
$this->id->aliasFieldName = $this->id->tableName . "_" . $this->id->fieldName;
$this->id->label = "Id";
$this->addType($this->id);

$this->groupId = new \Nemundo\Model\Type\Id\IdType();
$this->groupId->fieldName = "group";
$this->groupId->tableName = $this->parentFieldName . "_" . $this->externalTableName;
$this->groupId->aliasFieldName = $this->groupId->tableName ."_".$this->groupId->fieldName;
$this->groupId->label = "Group";
$this->addType($this->groupId);

$this->deadline = new \Nemundo\Model\Type\DateTime\DateType();
$this->deadline->fieldName = "deadline";
$this->deadline->tableName = $this->parentFieldName . "_" . $this->externalTableName;
$this->deadline->aliasFieldName = $this->deadline->tableName . "_" . $this->deadline->fieldName;
$this->deadline->label = "Deadline";
$this->addType($this->deadline);

}
public function loadGroup() {
if ($this->group == null) {
$this->group = new \Nemundo\Process\Group\Data\Group\GroupExternalType(null, $this->parentFieldName . "_group");
$this->group->fieldName = "group";
$this->group->tableName = $this->parentFieldName . "_" . $this->externalTableName;
$this->group->aliasFieldName = $this->group->tableName ."_".$this->group->fieldName;
$this->group->label = "Group";
$this->addType($this->group);
}
return $this;
}
}