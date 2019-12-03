<?php
namespace Nemundo\Process\Data\Status;
class StatusExternalType extends \Nemundo\Model\Type\External\ExternalType {
/**
* @var \Nemundo\Model\Type\Id\IdType
*/
public $id;

/**
* @var \Nemundo\Model\Type\Text\TextType
*/
public $statusLabel;

/**
* @var \Nemundo\Model\Type\Text\TextType
*/
public $statusClass;

protected function loadExternalType() {
parent::loadExternalType();
$this->externalModelClassName = StatusModel::class;
$this->externalTableName = "process_status";
$this->aliasTableName = $this->parentFieldName . "_" . $this->externalTableName;
$this->id = new \Nemundo\Model\Type\Id\IdType();
$this->id->fieldName = "id";
$this->id->tableName = $this->parentFieldName . "_" . $this->externalTableName;
$this->id->aliasFieldName = $this->id->tableName . "_" . $this->id->fieldName;
$this->id->label = "Id";
$this->addType($this->id);

$this->statusLabel = new \Nemundo\Model\Type\Text\TextType();
$this->statusLabel->fieldName = "status_label";
$this->statusLabel->tableName = $this->parentFieldName . "_" . $this->externalTableName;
$this->statusLabel->aliasFieldName = $this->statusLabel->tableName . "_" . $this->statusLabel->fieldName;
$this->statusLabel->label = "Status Label";
$this->addType($this->statusLabel);

$this->statusClass = new \Nemundo\Model\Type\Text\TextType();
$this->statusClass->fieldName = "status_class";
$this->statusClass->tableName = $this->parentFieldName . "_" . $this->externalTableName;
$this->statusClass->aliasFieldName = $this->statusClass->tableName . "_" . $this->statusClass->fieldName;
$this->statusClass->label = "Status Class";
$this->addType($this->statusClass);

}
}