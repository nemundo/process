<?php
namespace Nemundo\Process\Container\Data\Container;
class ContainerModel extends \Nemundo\Model\Definition\Model\AbstractModel {
/**
* @var \Nemundo\Model\Type\Id\IdType
*/
public $id;

/**
* @var \Nemundo\Model\Type\External\Id\ExternalIdType
*/
public $parentId;

/**
* @var \Nemundo\Process\Content\Data\Content\ContentExternalType
*/
public $parent;

/**
* @var \Nemundo\Model\Type\External\Id\ExternalIdType
*/
public $contentId;

/**
* @var \Nemundo\Process\Content\Data\Content\ContentExternalType
*/
public $content;

/**
* @var \Nemundo\Model\Type\Number\NumberType
*/
public $itemOrder;

protected function loadModel() {
$this->tableName = "container_container";
$this->aliasTableName = "container_container";
$this->label = "Container";

$this->primaryIndex = new \Nemundo\Db\Index\AutoIncrementIdPrimaryIndex();

$this->id = new \Nemundo\Model\Type\Id\IdType($this);
$this->id->tableName = "container_container";
$this->id->fieldName = "id";
$this->id->aliasFieldName = "container_container_id";
$this->id->label = "Id";
$this->id->allowNullValue = false;
$this->id->visible->form = false;
$this->id->visible->table = false;
$this->id->visible->view = false;
$this->id->visible->form = false;

$this->parentId = new \Nemundo\Model\Type\External\Id\ExternalIdType($this);
$this->parentId->tableName = "container_container";
$this->parentId->fieldName = "parent";
$this->parentId->aliasFieldName = "container_container_parent";
$this->parentId->label = "Parent";
$this->parentId->allowNullValue = false;

$this->contentId = new \Nemundo\Model\Type\External\Id\ExternalIdType($this);
$this->contentId->tableName = "container_container";
$this->contentId->fieldName = "content";
$this->contentId->aliasFieldName = "container_container_content";
$this->contentId->label = "Content";
$this->contentId->allowNullValue = false;

$this->itemOrder = new \Nemundo\Model\Type\Number\NumberType($this);
$this->itemOrder->tableName = "container_container";
$this->itemOrder->fieldName = "item_order";
$this->itemOrder->aliasFieldName = "container_container_item_order";
$this->itemOrder->label = "Item Order";
$this->itemOrder->allowNullValue = false;

$index = new \Nemundo\Model\Definition\Index\ModelIndex($this);
$index->indexName = "parent";

}
public function loadParent() {
if ($this->parent == null) {
$this->parent = new \Nemundo\Process\Content\Data\Content\ContentExternalType($this, "container_container_parent");
$this->parent->tableName = "container_container";
$this->parent->fieldName = "parent";
$this->parent->aliasFieldName = "container_container_parent";
$this->parent->label = "Parent";
}
return $this;
}
public function loadContent() {
if ($this->content == null) {
$this->content = new \Nemundo\Process\Content\Data\Content\ContentExternalType($this, "container_container_content");
$this->content->tableName = "container_container";
$this->content->fieldName = "content";
$this->content->aliasFieldName = "container_container_content";
$this->content->label = "Content";
}
return $this;
}
}