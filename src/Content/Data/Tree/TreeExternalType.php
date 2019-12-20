<?php
namespace Nemundo\Process\Content\Data\Tree;
class TreeExternalType extends \Nemundo\Model\Type\External\ExternalType {
/**
* @var \Nemundo\Model\Type\Id\IdType
*/
public $id;

/**
* @var \Nemundo\Model\Type\Id\IdType
*/
public $childId;

/**
* @var \Nemundo\Process\Content\Data\Document\DocumentExternalType
*/
public $child;

/**
* @var \Nemundo\Model\Type\Id\IdType
*/
public $parentId;

/**
* @var \Nemundo\Process\Content\Data\Document\DocumentExternalType
*/
public $parent;

protected function loadExternalType() {
parent::loadExternalType();
$this->externalModelClassName = TreeModel::class;
$this->externalTableName = "content_tree";
$this->aliasTableName = $this->parentFieldName . "_" . $this->externalTableName;
$this->id = new \Nemundo\Model\Type\Id\IdType();
$this->id->fieldName = "id";
$this->id->tableName = $this->parentFieldName . "_" . $this->externalTableName;
$this->id->aliasFieldName = $this->id->tableName . "_" . $this->id->fieldName;
$this->id->label = "Id";
$this->addType($this->id);

$this->childId = new \Nemundo\Model\Type\Id\IdType();
$this->childId->fieldName = "child";
$this->childId->tableName = $this->parentFieldName . "_" . $this->externalTableName;
$this->childId->aliasFieldName = $this->childId->tableName ."_".$this->childId->fieldName;
$this->childId->label = "Child";
$this->addType($this->childId);

$this->parentId = new \Nemundo\Model\Type\Id\IdType();
$this->parentId->fieldName = "parent";
$this->parentId->tableName = $this->parentFieldName . "_" . $this->externalTableName;
$this->parentId->aliasFieldName = $this->parentId->tableName ."_".$this->parentId->fieldName;
$this->parentId->label = "Parent";
$this->addType($this->parentId);

}
public function loadChild() {
if ($this->child == null) {
$this->child = new \Nemundo\Process\Content\Data\Document\DocumentExternalType(null, $this->parentFieldName . "_child");
$this->child->fieldName = "child";
$this->child->tableName = $this->parentFieldName . "_" . $this->externalTableName;
$this->child->aliasFieldName = $this->child->tableName ."_".$this->child->fieldName;
$this->child->label = "Child";
$this->addType($this->child);
}
return $this;
}
public function loadParent() {
if ($this->parent == null) {
$this->parent = new \Nemundo\Process\Content\Data\Document\DocumentExternalType(null, $this->parentFieldName . "_parent");
$this->parent->fieldName = "parent";
$this->parent->tableName = $this->parentFieldName . "_" . $this->externalTableName;
$this->parent->aliasFieldName = $this->parent->tableName ."_".$this->parent->fieldName;
$this->parent->label = "Parent";
$this->addType($this->parent);
}
return $this;
}
}