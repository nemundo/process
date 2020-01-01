<?php
namespace Nemundo\Process\Group\Data\GroupType;
class GroupTypeExternalType extends \Nemundo\Model\Type\External\ExternalType {
/**
* @var \Nemundo\Model\Type\Id\IdType
*/
public $id;

/**
* @var \Nemundo\Model\Type\Text\TextType
*/
public $groupType;

protected function loadExternalType() {
parent::loadExternalType();
$this->externalModelClassName = GroupTypeModel::class;
$this->externalTableName = "group_group_type";
$this->aliasTableName = $this->parentFieldName . "_" . $this->externalTableName;
$this->id = new \Nemundo\Model\Type\Id\IdType();
$this->id->fieldName = "id";
$this->id->tableName = $this->parentFieldName . "_" . $this->externalTableName;
$this->id->aliasFieldName = $this->id->tableName . "_" . $this->id->fieldName;
$this->id->label = "Id";
$this->addType($this->id);

$this->groupType = new \Nemundo\Model\Type\Text\TextType();
$this->groupType->fieldName = "group_type";
$this->groupType->tableName = $this->parentFieldName . "_" . $this->externalTableName;
$this->groupType->aliasFieldName = $this->groupType->tableName . "_" . $this->groupType->fieldName;
$this->groupType->label = "Group Type";
$this->addType($this->groupType);

}
}