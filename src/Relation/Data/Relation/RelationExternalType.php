<?php
namespace Nemundo\Process\Relation\Data\Relation;
class RelationExternalType extends \Nemundo\Model\Type\External\ExternalType {
/**
* @var \Nemundo\Model\Type\Id\IdType
*/
public $id;

/**
* @var \Nemundo\Model\Type\Id\IdType
*/
public $fromId;

/**
* @var \Nemundo\Process\Content\Data\Content\ContentExternalType
*/
public $from;

/**
* @var \Nemundo\Model\Type\Id\IdType
*/
public $toId;

/**
* @var \Nemundo\Process\Content\Data\Content\ContentExternalType
*/
public $to;

protected function loadExternalType() {
parent::loadExternalType();
$this->externalModelClassName = RelationModel::class;
$this->externalTableName = "process_relation";
$this->aliasTableName = $this->parentFieldName . "_" . $this->externalTableName;
$this->id = new \Nemundo\Model\Type\Id\IdType();
$this->id->fieldName = "id";
$this->id->tableName = $this->parentFieldName . "_" . $this->externalTableName;
$this->id->aliasFieldName = $this->id->tableName . "_" . $this->id->fieldName;
$this->id->label = "Id";
$this->addType($this->id);

$this->fromId = new \Nemundo\Model\Type\Id\IdType();
$this->fromId->fieldName = "from";
$this->fromId->tableName = $this->parentFieldName . "_" . $this->externalTableName;
$this->fromId->aliasFieldName = $this->fromId->tableName ."_".$this->fromId->fieldName;
$this->fromId->label = "From";
$this->addType($this->fromId);

$this->toId = new \Nemundo\Model\Type\Id\IdType();
$this->toId->fieldName = "to";
$this->toId->tableName = $this->parentFieldName . "_" . $this->externalTableName;
$this->toId->aliasFieldName = $this->toId->tableName ."_".$this->toId->fieldName;
$this->toId->label = "To";
$this->addType($this->toId);

}
public function loadFrom() {
if ($this->from == null) {
$this->from = new \Nemundo\Process\Content\Data\Content\ContentExternalType(null, $this->parentFieldName . "_from");
$this->from->fieldName = "from";
$this->from->tableName = $this->parentFieldName . "_" . $this->externalTableName;
$this->from->aliasFieldName = $this->from->tableName ."_".$this->from->fieldName;
$this->from->label = "From";
$this->addType($this->from);
}
return $this;
}
public function loadTo() {
if ($this->to == null) {
$this->to = new \Nemundo\Process\Content\Data\Content\ContentExternalType(null, $this->parentFieldName . "_to");
$this->to->fieldName = "to";
$this->to->tableName = $this->parentFieldName . "_" . $this->externalTableName;
$this->to->aliasFieldName = $this->to->tableName ."_".$this->to->fieldName;
$this->to->label = "To";
$this->addType($this->to);
}
return $this;
}
}