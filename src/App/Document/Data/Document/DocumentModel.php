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
* @var \Nemundo\Model\Type\Text\LargeTextType
*/
public $text;

/**
* @var \Nemundo\Model\Type\External\Id\ExternalIdType
*/
public $sourceId;

/**
* @var \Nemundo\Process\Content\Data\Content\ContentExternalType
*/
public $source;

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

$this->text = new \Nemundo\Model\Type\Text\LargeTextType($this);
$this->text->tableName = "document_document";
$this->text->fieldName = "text";
$this->text->aliasFieldName = "document_document_text";
$this->text->label = "Text";
$this->text->allowNullValue = false;

$this->sourceId = new \Nemundo\Model\Type\External\Id\ExternalIdType($this);
$this->sourceId->tableName = "document_document";
$this->sourceId->fieldName = "source";
$this->sourceId->aliasFieldName = "document_document_source";
$this->sourceId->label = "Source";
$this->sourceId->allowNullValue = false;

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
public function loadSource() {
if ($this->source == null) {
$this->source = new \Nemundo\Process\Content\Data\Content\ContentExternalType($this, "document_document_source");
$this->source->tableName = "document_document";
$this->source->fieldName = "source";
$this->source->aliasFieldName = "document_document_source";
$this->source->label = "Source";
}
return $this;
}
}