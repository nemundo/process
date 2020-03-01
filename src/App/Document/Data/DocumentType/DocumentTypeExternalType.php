<?php
namespace Nemundo\Process\App\Document\Data\DocumentType;
class DocumentTypeExternalType extends \Nemundo\Model\Type\External\ExternalType {
/**
* @var \Nemundo\Model\Type\Id\IdType
*/
public $id;

/**
* @var \Nemundo\Model\Type\Id\IdType
*/
public $contentTypeId;

/**
* @var \Nemundo\Process\Content\Data\ContentType\ContentTypeExternalType
*/
public $contentType;

/**
* @var \Nemundo\Model\Type\Number\YesNoType
*/
public $setupStatus;

protected function loadExternalType() {
parent::loadExternalType();
$this->externalModelClassName = DocumentTypeModel::class;
$this->externalTableName = "document_document_type";
$this->aliasTableName = $this->parentFieldName . "_" . $this->externalTableName;
$this->id = new \Nemundo\Model\Type\Id\IdType();
$this->id->fieldName = "id";
$this->id->tableName = $this->parentFieldName . "_" . $this->externalTableName;
$this->id->aliasFieldName = $this->id->tableName . "_" . $this->id->fieldName;
$this->id->label = "Id";
$this->addType($this->id);

$this->contentTypeId = new \Nemundo\Model\Type\Id\IdType();
$this->contentTypeId->fieldName = "content_type";
$this->contentTypeId->tableName = $this->parentFieldName . "_" . $this->externalTableName;
$this->contentTypeId->aliasFieldName = $this->contentTypeId->tableName ."_".$this->contentTypeId->fieldName;
$this->contentTypeId->label = "Content Type";
$this->addType($this->contentTypeId);

$this->setupStatus = new \Nemundo\Model\Type\Number\YesNoType();
$this->setupStatus->fieldName = "setup_status";
$this->setupStatus->tableName = $this->parentFieldName . "_" . $this->externalTableName;
$this->setupStatus->aliasFieldName = $this->setupStatus->tableName . "_" . $this->setupStatus->fieldName;
$this->setupStatus->label = "Setup Status";
$this->addType($this->setupStatus);

}
public function loadContentType() {
if ($this->contentType == null) {
$this->contentType = new \Nemundo\Process\Content\Data\ContentType\ContentTypeExternalType(null, $this->parentFieldName . "_content_type");
$this->contentType->fieldName = "content_type";
$this->contentType->tableName = $this->parentFieldName . "_" . $this->externalTableName;
$this->contentType->aliasFieldName = $this->contentType->tableName ."_".$this->contentType->fieldName;
$this->contentType->label = "Content Type";
$this->addType($this->contentType);
}
return $this;
}
}