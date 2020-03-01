<?php
namespace Nemundo\Process\App\Document\Data\Document;
class DocumentModel extends \Nemundo\Model\Definition\Model\AbstractModel {
/**
* @var \Nemundo\Model\Type\Id\IdType
*/
public $id;

/**
* @var \Nemundo\Model\Type\External\Id\ExternalIdType
*/
public $contentId;

/**
* @var \Nemundo\Process\Content\Data\Content\ContentExternalType
*/
public $content;

/**
* @var \Nemundo\Model\Type\Text\TextType
*/
public $title;

/**
* @var \Nemundo\Model\Type\Number\YesNoType
*/
public $closed;

/**
* @var \Nemundo\Model\Type\External\Id\ExternalUniqueIdType
*/
public $documentTypeId;

/**
* @var \Nemundo\Process\Content\Data\ContentType\ContentTypeExternalType
*/
public $documentType;

protected function loadModel() {
$this->tableName = "document_document";
$this->aliasTableName = "document_document";
$this->label = "Document";

$this->primaryIndex = new \Nemundo\Db\Index\AutoIncrementIdPrimaryIndex();

$this->id = new \Nemundo\Model\Type\Id\IdType($this);
$this->id->tableName = "document_document";
$this->id->fieldName = "id";
$this->id->aliasFieldName = "document_document_id";
$this->id->label = "Id";
$this->id->allowNullValue = false;
$this->id->visible->form = false;
$this->id->visible->table = false;
$this->id->visible->view = false;
$this->id->visible->form = false;

$this->contentId = new \Nemundo\Model\Type\External\Id\ExternalIdType($this);
$this->contentId->tableName = "document_document";
$this->contentId->fieldName = "content";
$this->contentId->aliasFieldName = "document_document_content";
$this->contentId->label = "Content";
$this->contentId->allowNullValue = false;

$this->title = new \Nemundo\Model\Type\Text\TextType($this);
$this->title->tableName = "document_document";
$this->title->fieldName = "title";
$this->title->aliasFieldName = "document_document_title";
$this->title->label = "Title";
$this->title->allowNullValue = false;
$this->title->length = 255;

$this->closed = new \Nemundo\Model\Type\Number\YesNoType($this);
$this->closed->tableName = "document_document";
$this->closed->fieldName = "closed";
$this->closed->aliasFieldName = "document_document_closed";
$this->closed->label = "Closed";
$this->closed->allowNullValue = false;

$this->documentTypeId = new \Nemundo\Model\Type\External\Id\ExternalUniqueIdType($this);
$this->documentTypeId->tableName = "document_document";
$this->documentTypeId->fieldName = "document_type";
$this->documentTypeId->aliasFieldName = "document_document_document_type";
$this->documentTypeId->label = "Document Type";
$this->documentTypeId->allowNullValue = false;

$index = new \Nemundo\Model\Definition\Index\ModelUniqueIndex($this);
$index->indexName = "content";
$index->addType($this->contentId);

}
public function loadContent() {
if ($this->content == null) {
$this->content = new \Nemundo\Process\Content\Data\Content\ContentExternalType($this, "document_document_content");
$this->content->tableName = "document_document";
$this->content->fieldName = "content";
$this->content->aliasFieldName = "document_document_content";
$this->content->label = "Content";
}
return $this;
}
public function loadDocumentType() {
if ($this->documentType == null) {
$this->documentType = new \Nemundo\Process\Content\Data\ContentType\ContentTypeExternalType($this, "document_document_document_type");
$this->documentType->tableName = "document_document";
$this->documentType->fieldName = "document_type";
$this->documentType->aliasFieldName = "document_document_document_type";
$this->documentType->label = "Document Type";
}
return $this;
}
}