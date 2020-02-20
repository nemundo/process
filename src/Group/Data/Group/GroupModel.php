<?php
namespace Nemundo\Process\Group\Data\Group;
class GroupModel extends \Nemundo\Model\Template\AbstractActiveModel {
/**
* @var \Nemundo\Model\Type\Id\IdType
*/
public $id;

/**
* @var \Nemundo\Model\Type\Text\TextType
*/
public $group;

/**
* @var \Nemundo\Model\Type\External\Id\ExternalUniqueIdType
*/
public $groupTypeId;

/**
* @var \Nemundo\Process\Content\Data\ContentType\ContentTypeExternalType
*/
public $groupType;

protected function loadModel() {
$this->tableName = "group_group";
$this->aliasTableName = "group_group";
$this->label = "Group";

$this->primaryIndex = new \Nemundo\Db\Index\TextIdPrimaryIndex();

$this->id = new \Nemundo\Model\Type\Id\IdType($this);
$this->id->tableName = "group_group";
$this->id->fieldName = "id";
$this->id->aliasFieldName = "group_group_id";
$this->id->label = "Id";
$this->id->allowNullValue = false;
$this->id->visible->form = false;
$this->id->visible->table = false;
$this->id->visible->view = false;
$this->id->visible->form = false;


$this->group = new \Nemundo\Model\Type\Text\TextType($this);
$this->group->tableName = "group_group";
$this->group->fieldName = "group";
$this->group->aliasFieldName = "group_group_group";
$this->group->label = "Group";
$this->group->allowNullValue = false;
$this->group->length = 255;

$this->groupTypeId = new \Nemundo\Model\Type\External\Id\ExternalUniqueIdType($this);
$this->groupTypeId->tableName = "group_group";
$this->groupTypeId->fieldName = "group_type";
$this->groupTypeId->aliasFieldName = "group_group_group_type";
$this->groupTypeId->label = "Group Type";
$this->groupTypeId->allowNullValue = false;

$index = new \Nemundo\Model\Definition\Index\ModelIndex($this);
$index->indexName = "group_type";
$index->addType($this->groupTypeId);

}
public function loadGroupType() {
if ($this->groupType == null) {
$this->groupType = new \Nemundo\Process\Content\Data\ContentType\ContentTypeExternalType($this, "group_group_group_type");
$this->groupType->tableName = "group_group";
$this->groupType->fieldName = "group_type";
$this->groupType->aliasFieldName = "group_group_group_type";
$this->groupType->label = "Group Type";
}
return $this;
}
}