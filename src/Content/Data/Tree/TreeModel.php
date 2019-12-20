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
* @var \Nemundo\Process\Content\Data\Document\DocumentExternalType
*/
public $child;

/**
* @var \Nemundo\Model\Type\External\Id\ExternalIdType
*/
public $parentId;

/**
* @var \Nemundo\Process\Content\Data\Document\DocumentExternalType
*/
public $parent;

protected function loadModel() {
$this->tableName = "content_tree";
$this->aliasTableName = "content_tree";
$this->label = "Tree";

$this->primaryIndex = new \Nemundo\Db\Index\AutoIncrementIdPrimaryIndex();

$this->id = new \Nemundo\Model\Type\Id\IdType($this);
$this->id->tableName = "content_tree";
$this->id->fieldName = "id";
$this->id->aliasFieldName = "content_tree_id";
$this->id->label = "Id";
$this->id->allowNullValue = false;
$this->id->visible->form = false;
$this->id->visible->table = false;
$this->id->visible->view = false;
$this->id->visible->form = false;

$this->childId = new \Nemundo\Model\Type\External\Id\ExternalIdType($this);
$this->childId->tableName = "content_tree";
$this->childId->fieldName = "child";
$this->childId->aliasFieldName = "content_tree_child";
$this->childId->label = "Child";
$this->childId->allowNullValue = false;

$this->parentId = new \Nemundo\Model\Type\External\Id\ExternalIdType($this);
$this->parentId->tableName = "content_tree";
$this->parentId->fieldName = "parent";
$this->parentId->aliasFieldName = "content_tree_parent";
$this->parentId->label = "Parent";
$this->parentId->allowNullValue = false;

}
public function loadChild() {
if ($this->child == null) {
$this->child = new \Nemundo\Process\Content\Data\Document\DocumentExternalType($this, "content_tree_child");
$this->child->tableName = "content_tree";
$this->child->fieldName = "child";
$this->child->aliasFieldName = "content_tree_child";
$this->child->label = "Child";
}
return $this;
}
public function loadParent() {
if ($this->parent == null) {
$this->parent = new \Nemundo\Process\Content\Data\Document\DocumentExternalType($this, "content_tree_parent");
$this->parent->tableName = "content_tree";
$this->parent->fieldName = "parent";
$this->parent->aliasFieldName = "content_tree_parent";
$this->parent->label = "Parent";
}
return $this;
}
}