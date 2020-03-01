<?php
namespace Nemundo\Process\App\Document\Data\Document;
class DocumentExternalType extends \Nemundo\Model\Type\External\ExternalType {
/**
* @var \Nemundo\Model\Type\Id\IdType
*/
public $id;

/**
* @var \Nemundo\Model\Type\Id\IdType
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
* @var \Nemundo\Model\Type\Id\IdType
*/
public $documentTypeId;

/**
* @var \Nemundo\Process\Content\Data\ContentType\ContentTypeExternalType
*/
public $documentType;

protected function loadExternalType() {
parent::loadExternalType();
$this->externalModelClassName = DocumentModel::class;
$this->externalTableName = "document_document";
$this->aliasTableName = $this->parentFieldName . "_" . $this->externalTableName;
$this->id = new \Nemundo\Model\Type\Id\IdType();
$this->id->fieldName = "id";
$this->id->tableName = $this->parentFieldName . "_" . $this->externalTableName;
$this->id->aliasFieldName = $this->id->tableName . "_" . $this->id->fieldName;
$this->id->label = "Id";
$this->addType($this->id);

$this->contentId = new \Nemundo\Model\Type\Id\IdType();
$this->contentId->fieldName = "content";
$this->contentId->tableName = $this->parentFieldName . "_" . $this->externalTableName;
$this->contentId->aliasFieldName = $this->contentId->tableName ."_".$this->contentId->fieldName;
$this->contentId->label = "Content";
$this->addType($this->contentId);

$this->title = new \Nemundo\Model\Type\Text\TextType();
$this->title->fieldName = "title";
$this->title->tableName = $this->parentFieldName . "_" . $this->externalTableName;
$this->title->aliasFieldName = $this->title->tableName . "_" . $this->title->fieldName;
$this->title->label = "Title";
$this->addType($this->title);

$this->closed = new \Nemundo\Model\Type\Number\YesNoType();
$this->closed->fieldName = "closed";
$this->closed->tableName = $this->parentFieldName . "_" . $this->externalTableName;
$this->closed->aliasFieldName = $this->closed->tableName . "_" . $this->closed->fieldName;
$this->closed->label = "Closed";
$this->addType($this->closed);

$this->documentTypeId = new \Nemundo\Model\Type\Id\IdType();
$this->documentTypeId->fieldName = "document_type";
$this->documentTypeId->tableName = $this->parentFieldName . "_" . $this->externalTableName;
$this->documentTypeId->aliasFieldName = $this->documentTypeId->tableName ."_".$this->documentTypeId->fieldName;
$this->documentTypeId->label = "Document Type";
$this->addType($this->documentTypeId);

}
public function loadContent() {
if ($this->content == null) {
$this->content = new \Nemundo\Process\Content\Data\Content\ContentExternalType(null, $this->parentFieldName . "_content");
$this->content->fieldName = "content";
$this->content->tableName = $this->parentFieldName . "_" . $this->externalTableName;
$this->content->aliasFieldName = $this->content->tableName ."_".$this->content->fieldName;
$this->content->label = "Content";
$this->addType($this->content);
}
return $this;
}
public function loadDocumentType() {
if ($this->documentType == null) {
$this->documentType = new \Nemundo\Process\Content\Data\ContentType\ContentTypeExternalType(null, $this->parentFieldName . "_document_type");
$this->documentType->fieldName = "document_type";
$this->documentType->tableName = $this->parentFieldName . "_" . $this->externalTableName;
$this->documentType->aliasFieldName = $this->documentType->tableName ."_".$this->documentType->fieldName;
$this->documentType->label = "Document Type";
$this->addType($this->documentType);
}
return $this;
}
}