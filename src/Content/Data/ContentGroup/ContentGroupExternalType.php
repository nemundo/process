<?php
namespace Nemundo\Process\Content\Data\ContentGroup;
class ContentGroupExternalType extends \Nemundo\Model\Type\External\ExternalType {
/**
* @var \Nemundo\Model\Type\Id\IdType
*/
public $id;

/**
* @var \Nemundo\Model\Type\Id\IdType
*/
public $contentId;

/**
* @var \Nemundo\Process\Content\Data\Content\ContentExternalType
*/
public $content;

/**
* @var \Nemundo\Model\Type\Id\IdType
*/
public $groupId;

/**
* @var \Nemundo\Process\Group\Data\Group\GroupExternalType
*/
public $group;

protected function loadExternalType() {
parent::loadExternalType();
$this->externalModelClassName = ContentGroupModel::class;
$this->externalTableName = "content_content_group";
$this->aliasTableName = $this->parentFieldName . "_" . $this->externalTableName;
$this->id = new \Nemundo\Model\Type\Id\IdType();
$this->id->fieldName = "id";
$this->id->tableName = $this->parentFieldName . "_" . $this->externalTableName;
$this->id->aliasFieldName = $this->id->tableName . "_" . $this->id->fieldName;
$this->id->label = "Id";
$this->addType($this->id);

$this->contentId = new \Nemundo\Model\Type\Id\IdType();
$this->contentId->fieldName = "content";
$this->contentId->tableName = $this->parentFieldName . "_" . $this->externalTableName;
$this->contentId->aliasFieldName = $this->contentId->tableName ."_".$this->contentId->fieldName;
$this->contentId->label = "Content";
$this->addType($this->contentId);

$this->groupId = new \Nemundo\Model\Type\Id\IdType();
$this->groupId->fieldName = "group";
$this->groupId->tableName = $this->parentFieldName . "_" . $this->externalTableName;
$this->groupId->aliasFieldName = $this->groupId->tableName ."_".$this->groupId->fieldName;
$this->groupId->label = "Group";
$this->addType($this->groupId);

}
public function loadContent() {
if ($this->content == null) {
$this->content = new \Nemundo\Process\Content\Data\Content\ContentExternalType(null, $this->parentFieldName . "_content");
$this->content->fieldName = "content";
$this->content->tableName = $this->parentFieldName . "_" . $this->externalTableName;
$this->content->aliasFieldName = $this->content->tableName ."_".$this->content->fieldName;
$this->content->label = "Content";
$this->addType($this->content);
}
return $this;
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