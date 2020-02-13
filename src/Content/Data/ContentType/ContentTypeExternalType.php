<?php
namespace Nemundo\Process\Content\Data\ContentType;
class ContentTypeExternalType extends \Nemundo\Model\Type\External\ExternalType {
/**
* @var \Nemundo\Model\Type\Id\IdType
*/
public $id;

/**
* @var \Nemundo\Model\Type\Text\TextType
*/
public $phpClass;

/**
* @var \Nemundo\Model\Type\Text\TextType
*/
public $contentType;

/**
* @var \Nemundo\Model\Type\Number\YesNoType
*/
public $setupStatus;

protected function loadExternalType() {
parent::loadExternalType();
$this->externalModelClassName = ContentTypeModel::class;
$this->externalTableName = "process_content_type";
$this->aliasTableName = $this->parentFieldName . "_" . $this->externalTableName;
$this->id = new \Nemundo\Model\Type\Id\IdType();
$this->id->fieldName = "id";
$this->id->tableName = $this->parentFieldName . "_" . $this->externalTableName;
$this->id->aliasFieldName = $this->id->tableName . "_" . $this->id->fieldName;
$this->id->label = "Id";
$this->addType($this->id);

$this->phpClass = new \Nemundo\Model\Type\Text\TextType();
$this->phpClass->fieldName = "php_class";
$this->phpClass->tableName = $this->parentFieldName . "_" . $this->externalTableName;
$this->phpClass->aliasFieldName = $this->phpClass->tableName . "_" . $this->phpClass->fieldName;
$this->phpClass->label = "Php Class";
$this->addType($this->phpClass);

$this->contentType = new \Nemundo\Model\Type\Text\TextType();
$this->contentType->fieldName = "content_type";
$this->contentType->tableName = $this->parentFieldName . "_" . $this->externalTableName;
$this->contentType->aliasFieldName = $this->contentType->tableName . "_" . $this->contentType->fieldName;
$this->contentType->label = "Content Type";
$this->addType($this->contentType);

$this->setupStatus = new \Nemundo\Model\Type\Number\YesNoType();
$this->setupStatus->fieldName = "setup_status";
$this->setupStatus->tableName = $this->parentFieldName . "_" . $this->externalTableName;
$this->setupStatus->aliasFieldName = $this->setupStatus->tableName . "_" . $this->setupStatus->fieldName;
$this->setupStatus->label = "Setup Status";
$this->addType($this->setupStatus);

}
}