<?php
namespace Nemundo\Process\Content\Data\Tree;
class TreeModel extends \Nemundo\Model\Definition\Model\AbstractModel {
/**
* @var \Nemundo\Model\Type\Id\IdType
*/
public $id;

/**
* @var \Nemundo\Model\Type\External\Id\ExternalIdType
*/
public $childId;

/**
* @var \Nemundo\Process\Content\Data\Content\ContentExternalType
*/
public $child;

/**
* @var \Nemundo\Model\Type\External\Id\ExternalIdType
*/
public $parentId;

/**
* @var \Nemundo\Process\Content\Data\Content\ContentExternalType
*/
public $parent;

/**
* @var \Nemundo\Model\Type\Number\NumberType
*/
public $itemOrder;

protected function loadModel() {
$this->tableName = "process_content_tree";
$this->aliasTableName = "process_content_tree";
$this->label = "Tree";

$this->primaryIndex = new \Nemundo\Db\Index\AutoIncrementIdPrimaryIndex();

$this->id = new \Nemundo\Model\Type\Id\IdType($this);
$this->id->tableName = "process_content_tree";
$this->id->fieldName = "id";
$this->id->aliasFieldName = "process_content_tree_id";
$this->id->label = "Id";
$this->id->allowNullValue = false;
$this->id->visible->form = false;
$this->id->visible->table = false;
$this->id->visible->view = false;
$this->id->visible->form = false;

$this->childId = new \Nemundo\Model\Type\External\Id\ExternalIdType($this);
$this->childId->tableName = "process_content_tree";
$this->childId->fieldName = "child";
$this->childId->aliasFieldName = "process_content_tree_child";
$this->childId->label = "Child";
$this->childId->allowNullValue = false;

$this->parentId = new \Nemundo\Model\Type\External\Id\ExternalIdType($this);
$this->parentId->tableName = "process_content_tree";
$this->parentId->fieldName = "parent";
$this->parentId->aliasFieldName = "process_content_tree_parent";
$this->parentId->label = "Parent";
$this->parentId->allowNullValue = false;

$this->itemOrder = new \Nemundo\Model\Type\Number\NumberType($this);
$this->itemOrder->tableName = "process_content_tree";
$this->itemOrder->fieldName = "item_order";
$this->itemOrder->aliasFieldName = "process_content_tree_item_order";
$this->itemOrder->label = "Item Order";
$this->itemOrder->allowNullValue = false;

$index = new \Nemundo\Model\Definition\Index\ModelIndex($this);
$index->indexName = "parent";
$index->addType($this->parentId);

$index = new \Nemundo\Model\Definition\Index\ModelIndex($this);
$index->indexName = "child";
$index->addType($this->childId);

$index = new \Nemundo\Model\Definition\Index\ModelUniqueIndex($this);
$index->indexName = "parent_child";
$index->addType($this->parentId);
$index->addType($this->childId);

}
public function loadChild() {
if ($this->child == null) {
$this->child = new \Nemundo\Process\Content\Data\Content\ContentExternalType($this, "process_content_tree_child");
$this->child->tableName = "process_content_tree";
$this->child->fieldName = "child";
$this->child->aliasFieldName = "process_content_tree_child";
$this->child->label = "Child";
}
return $this;
}
public function loadParent() {
if ($this->parent == null) {
$this->parent = new \Nemundo\Process\Content\Data\Content\ContentExternalType($this, "process_content_tree_parent");
$this->parent->tableName = "process_content_tree";
$this->parent->fieldName = "parent";
$this->parent->aliasFieldName = "process_content_tree_parent";
$this->parent->label = "Parent";
}
return $this;
}
}