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

/**
* @var \Nemundo\Model\Type\External\Id\ExternalIdType
*/
public $contentId;

/**
* @var \Nemundo\Process\Content\Data\Content\ContentExternalType
*/
public $content;

protected function loadModel() {
$this->tableName = "process_group";
$this->aliasTableName = "process_group";
$this->label = "Group";

$this->primaryIndex = new \Nemundo\Db\Index\AutoIncrementIdPrimaryIndex();

$this->id = new \Nemundo\Model\Type\Id\IdType($this);
$this->id->tableName = "process_group";
$this->id->fieldName = "id";
$this->id->aliasFieldName = "process_group_id";
$this->id->label = "Id";
$this->id->allowNullValue = false;
$this->id->visible->form = false;
$this->id->visible->table = false;
$this->id->visible->view = false;
$this->id->visible->form = false;


$this->group = new \Nemundo\Model\Type\Text\TextType($this);
$this->group->tableName = "process_group";
$this->group->fieldName = "group";
$this->group->aliasFieldName = "process_group_group";
$this->group->label = "Group";
$this->group->allowNullValue = false;
$this->group->length = 255;

$this->groupTypeId = new \Nemundo\Model\Type\External\Id\ExternalUniqueIdType($this);
$this->groupTypeId->tableName = "process_group";
$this->groupTypeId->fieldName = "group_type";
$this->groupTypeId->aliasFieldName = "process_group_group_type";
$this->groupTypeId->label = "Group Type";
$this->groupTypeId->allowNullValue = false;

$this->contentId = new \Nemundo\Model\Type\External\Id\ExternalIdType($this);
$this->contentId->tableName = "process_group";
$this->contentId->fieldName = "content";
$this->contentId->aliasFieldName = "process_group_content";
$this->contentId->label = "Content";
$this->contentId->allowNullValue = false;

$index = new \Nemundo\Model\Definition\Index\ModelIndex($this);
$index->indexName = "group_type";
$index->addType($this->groupTypeId);

$index = new \Nemundo\Model\Definition\Index\ModelUniqueIndex($this);
$index->indexName = "content";
$index->addType($this->contentId);

}
public function loadGroupType() {
if ($this->groupType == null) {
$this->groupType = new \Nemundo\Process\Content\Data\ContentType\ContentTypeExternalType($this, "process_group_group_type");
$this->groupType->tableName = "process_group";
$this->groupType->fieldName = "group_type";
$this->groupType->aliasFieldName = "process_group_group_type";
$this->groupType->label = "Group Type";
}
return $this;
}
public function loadContent() {
if ($this->content == null) {
$this->content = new \Nemundo\Process\Content\Data\Content\ContentExternalType($this, "process_group_content");
$this->content->tableName = "process_group";
$this->content->fieldName = "content";
$this->content->aliasFieldName = "process_group_content";
$this->content->label = "Content";
}
return $this;
}
}