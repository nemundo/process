<?php
namespace Nemundo\Process\Content\Data\Document;
class DocumentModel extends \Nemundo\Model\Definition\Model\AbstractModel {
/**
* @var \Nemundo\Model\Type\Id\IdType
*/
public $id;

/**
* @var \Nemundo\Model\Type\Text\TextType
*/
public $dataId;

/**
* @var \Nemundo\Model\Type\Text\TextType
*/
public $subject;

/**
* @var \Nemundo\Model\Type\Text\LargeTextType
*/
public $text;

protected function loadModel() {
$this->tableName = "content_document";
$this->aliasTableName = "content_document";
$this->label = "Document";

$this->primaryIndex = new \Nemundo\Db\Index\AutoIncrementIdPrimaryIndex();

$this->id = new \Nemundo\Model\Type\Id\IdType($this);
$this->id->tableName = "content_document";
$this->id->fieldName = "id";
$this->id->aliasFieldName = "content_document_id";
$this->id->label = "Id";
$this->id->allowNullValue = false;
$this->id->visible->form = false;
$this->id->visible->table = false;
$this->id->visible->view = false;
$this->id->visible->form = false;

$this->dataId = new \Nemundo\Model\Type\Text\TextType($this);
$this->dataId->tableName = "content_document";
$this->dataId->fieldName = "data_id";
$this->dataId->aliasFieldName = "content_document_data_id";
$this->dataId->label = "Data Id";
$this->dataId->allowNullValue = false;
$this->dataId->length = 36;

$this->subject = new \Nemundo\Model\Type\Text\TextType($this);
$this->subject->tableName = "content_document";
$this->subject->fieldName = "subject";
$this->subject->aliasFieldName = "content_document_subject";
$this->subject->label = "Subject";
$this->subject->allowNullValue = false;
$this->subject->length = 255;

$this->text = new \Nemundo\Model\Type\Text\LargeTextType($this);
$this->text->tableName = "content_document";
$this->text->fieldName = "text";
$this->text->aliasFieldName = "content_document_text";
$this->text->label = "Text";
$this->text->allowNullValue = false;

}
}