<?php
namespace Nemundo\Process\Group\Data\Group;
class GroupExternalType extends \Nemundo\Model\Type\External\ExternalType {
/**
* @var \Nemundo\Model\Type\Id\IdType
*/
public $id;

/**
* @var \Nemundo\Model\Type\Text\TextType
*/
public $group;

protected function loadExternalType() {
parent::loadExternalType();
$this->externalModelClassName = GroupModel::class;
$this->externalTableName = "group_group";
$this->aliasTableName = $this->parentFieldName . "_" . $this->externalTableName;
$this->id = new \Nemundo\Model\Type\Id\IdType();
$this->id->fieldName = "id";
$this->id->tableName = $this->parentFieldName . "_" . $this->externalTableName;
$this->id->aliasFieldName = $this->id->tableName . "_" . $this->id->fieldName;
$this->id->label = "Id";
$this->addType($this->id);

$this->group = new \Nemundo\Model\Type\Text\TextType();
$this->group->fieldName = "group";
$this->group->tableName = $this->parentFieldName . "_" . $this->externalTableName;
$this->group->aliasFieldName = $this->group->tableName . "_" . $this->group->fieldName;
$this->group->label = "Group";
$this->addType($this->group);

}
}