<?php
namespace Nemundo\Process\Group\Data\GroupType;
class GroupTypeModel extends \Nemundo\Model\Definition\Model\AbstractModel {
/**
* @var \Nemundo\Model\Type\Id\IdType
*/
public $id;

/**
* @var \Nemundo\Model\Type\External\Id\ExternalUniqueIdType
*/
public $groupTypeId;

/**
* @var \Nemundo\Process\Content\Data\ContentType\ContentTypeExternalType
*/
public $groupType;

protected function loadModel() {
$this->tableName = "group_group_type";
$this->aliasTableName = "group_group_type";
$this->label = "Group Type";

$this->primaryIndex = new \Nemundo\Db\Index\AutoIncrementIdPrimaryIndex();

$this->id = new \Nemundo\Model\Type\Id\IdType($this);
$this->id->tableName = "group_group_type";
$this->id->fieldName = "id";
$this->id->aliasFieldName = "group_group_type_id";
$this->id->label = "Id";
$this->id->allowNullValue = false;
$this->id->visible->form = false;
$this->id->visible->table = false;
$this->id->visible->view = false;
$this->id->visible->form = false;

$this->groupTypeId = new \Nemundo\Model\Type\External\Id\ExternalUniqueIdType($this);
$this->groupTypeId->tableName = "group_group_type";
$this->groupTypeId->fieldName = "group_type";
$this->groupTypeId->aliasFieldName = "group_group_type_group_type";
$this->groupTypeId->label = "Group Type";
$this->groupTypeId->allowNullValue = false;

$index = new \Nemundo\Model\Definition\Index\ModelUniqueIndex($this);
$index->indexName = "group_type";
$index->addType($this->groupTypeId);

}
public function loadGroupType() {
if ($this->groupType == null) {
$this->groupType = new \Nemundo\Process\Content\Data\ContentType\ContentTypeExternalType($this, "group_group_type_group_type");
$this->groupType->tableName = "group_group_type";
$this->groupType->fieldName = "group_type";
$this->groupType->aliasFieldName = "group_group_type_group_type";
$this->groupType->label = "Group Type";
}
return $this;
}
}