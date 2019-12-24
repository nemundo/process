<?php
namespace Nemundo\Process\Content\Data\ContentGroup;
class ContentGroupModel extends \Nemundo\Model\Definition\Model\AbstractModel {
/**
* @var \Nemundo\Model\Type\Id\IdType
*/
public $id;

/**
* @var \Nemundo\Model\Type\External\Id\ExternalUniqueIdType
*/
public $contentId;

/**
* @var \Nemundo\Process\Content\Data\Content\ContentExternalType
*/
public $content;

/**
* @var \Nemundo\Model\Type\External\Id\ExternalUniqueIdType
*/
public $groupId;

/**
* @var \Nemundo\Process\Group\Data\Group\GroupExternalType
*/
public $group;

protected function loadModel() {
$this->tableName = "content_content_group";
$this->aliasTableName = "content_content_group";
$this->label = "Content Group";

$this->primaryIndex = new \Nemundo\Db\Index\AutoIncrementIdPrimaryIndex();

$this->id = new \Nemundo\Model\Type\Id\IdType($this);
$this->id->tableName = "content_content_group";
$this->id->fieldName = "id";
$this->id->aliasFieldName = "content_content_group_id";
$this->id->label = "Id";
$this->id->allowNullValue = false;
$this->id->visible->form = false;
$this->id->visible->table = false;
$this->id->visible->view = false;
$this->id->visible->form = false;

$this->contentId = new \Nemundo\Model\Type\External\Id\ExternalUniqueIdType($this);
$this->contentId->tableName = "content_content_group";
$this->contentId->fieldName = "content";
$this->contentId->aliasFieldName = "content_content_group_content";
$this->contentId->label = "Content";
$this->contentId->allowNullValue = false;

$this->groupId = new \Nemundo\Model\Type\External\Id\ExternalUniqueIdType($this);
$this->groupId->tableName = "content_content_group";
$this->groupId->fieldName = "group";
$this->groupId->aliasFieldName = "content_content_group_group";
$this->groupId->label = "Group";
$this->groupId->allowNullValue = false;

}
public function loadContent() {
if ($this->content == null) {
$this->content = new \Nemundo\Process\Content\Data\Content\ContentExternalType($this, "content_content_group_content");
$this->content->tableName = "content_content_group";
$this->content->fieldName = "content";
$this->content->aliasFieldName = "content_content_group_content";
$this->content->label = "Content";
}
return $this;
}
public function loadGroup() {
if ($this->group == null) {
$this->group = new \Nemundo\Process\Group\Data\Group\GroupExternalType($this, "content_content_group_group");
$this->group->tableName = "content_content_group";
$this->group->fieldName = "group";
$this->group->aliasFieldName = "content_content_group_group";
$this->group->label = "Group";
}
return $this;
}
}