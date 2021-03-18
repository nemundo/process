<?php
namespace Nemundo\Process\App\Document\Data\DocumentType;
class DocumentTypeModel extends \Nemundo\Model\Definition\Model\AbstractModel {
/**
* @var \Nemundo\Model\Type\Id\IdType
*/
public $id;

/**
* @var \Nemundo\Model\Type\External\Id\ExternalUniqueIdType
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

protected function loadModel() {
$this->tableName = "process_document_type";
$this->aliasTableName = "process_document_type";
$this->label = "Document Type";

$this->primaryIndex = new \Nemundo\Db\Index\AutoIncrementIdPrimaryIndex();

$this->id = new \Nemundo\Model\Type\Id\IdType($this);
$this->id->tableName = "process_document_type";
$this->id->fieldName = "id";
$this->id->aliasFieldName = "process_document_type_id";
$this->id->label = "Id";
$this->id->allowNullValue = false;

$this->contentTypeId = new \Nemundo\Model\Type\External\Id\ExternalUniqueIdType($this);
$this->contentTypeId->tableName = "process_document_type";
$this->contentTypeId->fieldName = "content_type";
$this->contentTypeId->aliasFieldName = "process_document_type_content_type";
$this->contentTypeId->label = "Content Type";
$this->contentTypeId->allowNullValue = false;

$this->setupStatus = new \Nemundo\Model\Type\Number\YesNoType($this);
$this->setupStatus->tableName = "process_document_type";
$this->setupStatus->fieldName = "setup_status";
$this->setupStatus->aliasFieldName = "process_document_type_setup_status";
$this->setupStatus->label = "Setup Status";
$this->setupStatus->allowNullValue = false;

$index = new \Nemundo\Model\Definition\Index\ModelUniqueIndex($this);
$index->indexName = "content_type";
$index->addType($this->contentTypeId);

}
public function loadContentType() {
if ($this->contentType == null) {
$this->contentType = new \Nemundo\Process\Content\Data\ContentType\ContentTypeExternalType($this, "process_document_type_content_type");
$this->contentType->tableName = "process_document_type";
$this->contentType->fieldName = "content_type";
$this->contentType->aliasFieldName = "process_document_type_content_type";
$this->contentType->label = "Content Type";
}
return $this;
}
}