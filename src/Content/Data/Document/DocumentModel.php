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

/**
* @var \Nemundo\Model\Type\DateTime\DateTimeType
*/
public $dateTime;

/**
* @var \Nemundo\Model\Type\External\Id\ExternalUniqueIdType
*/
public $userId;

/**
* @var \Nemundo\User\Data\User\UserExternalType
*/
public $user;

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

$this->dateTime = new \Nemundo\Model\Type\DateTime\DateTimeType($this);
$this->dateTime->tableName = "content_document";
$this->dateTime->fieldName = "date_time";
$this->dateTime->aliasFieldName = "content_document_date_time";
$this->dateTime->label = "Date Time";
$this->dateTime->allowNullValue = false;

$this->userId = new \Nemundo\Model\Type\External\Id\ExternalUniqueIdType($this);
$this->userId->tableName = "content_document";
$this->userId->fieldName = "user";
$this->userId->aliasFieldName = "content_document_user";
$this->userId->label = "User";
$this->userId->allowNullValue = false;

}
public function loadUser() {
if ($this->user == null) {
$this->user = new \Nemundo\User\Data\User\UserExternalType($this, "content_document_user");
$this->user->tableName = "content_document";
$this->user->fieldName = "user";
$this->user->aliasFieldName = "content_document_user";
$this->user->label = "User";
}
return $this;
}
}