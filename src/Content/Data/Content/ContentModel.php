<?php
namespace Nemundo\Process\Content\Data\Content;
class ContentModel extends \Nemundo\Model\Definition\Model\AbstractModel {
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

/**
* @var \Nemundo\Model\Type\External\Id\ExternalUniqueIdType
*/
public $contentTypeId;

/**
* @var \Nemundo\Process\Content\Data\ContentType\ContentTypeExternalType
*/
public $contentType;

protected function loadModel() {
$this->tableName = "process_content";
$this->aliasTableName = "process_content";
$this->label = "Content";

$this->primaryIndex = new \Nemundo\Db\Index\AutoIncrementIdPrimaryIndex();

$this->id = new \Nemundo\Model\Type\Id\IdType($this);
$this->id->tableName = "process_content";
$this->id->fieldName = "id";
$this->id->aliasFieldName = "process_content_id";
$this->id->label = "Id";
$this->id->allowNullValue = false;
$this->id->visible->form = false;
$this->id->visible->table = false;
$this->id->visible->view = false;
$this->id->visible->form = false;

$this->dataId = new \Nemundo\Model\Type\Text\TextType($this);
$this->dataId->tableName = "process_content";
$this->dataId->fieldName = "data_id";
$this->dataId->aliasFieldName = "process_content_data_id";
$this->dataId->label = "Data Id";
$this->dataId->allowNullValue = true;
$this->dataId->length = 36;

$this->subject = new \Nemundo\Model\Type\Text\TextType($this);
$this->subject->tableName = "process_content";
$this->subject->fieldName = "subject";
$this->subject->aliasFieldName = "process_content_subject";
$this->subject->label = "Subject";
$this->subject->allowNullValue = false;
$this->subject->length = 255;

$this->dateTime = new \Nemundo\Model\Type\DateTime\DateTimeType($this);
$this->dateTime->tableName = "process_content";
$this->dateTime->fieldName = "date_time";
$this->dateTime->aliasFieldName = "process_content_date_time";
$this->dateTime->label = "Date Time";
$this->dateTime->allowNullValue = false;

$this->userId = new \Nemundo\Model\Type\External\Id\ExternalUniqueIdType($this);
$this->userId->tableName = "process_content";
$this->userId->fieldName = "user";
$this->userId->aliasFieldName = "process_content_user";
$this->userId->label = "User";
$this->userId->allowNullValue = false;

$this->contentTypeId = new \Nemundo\Model\Type\External\Id\ExternalUniqueIdType($this);
$this->contentTypeId->tableName = "process_content";
$this->contentTypeId->fieldName = "content_type";
$this->contentTypeId->aliasFieldName = "process_content_content_type";
$this->contentTypeId->label = "Content Type";
$this->contentTypeId->allowNullValue = false;

$index = new \Nemundo\Model\Definition\Index\ModelIndex($this);
$index->indexName = "content_type";
$index->addType($this->contentTypeId);

$index = new \Nemundo\Model\Definition\Index\ModelIndex($this);
$index->indexName = "date_time";
$index->addType($this->dateTime);

$index = new \Nemundo\Model\Definition\Index\ModelUniqueIndex($this);
$index->indexName = "content_type_data_id";
$index->addType($this->contentTypeId);
$index->addType($this->dataId);

}
public function loadUser() {
if ($this->user == null) {
$this->user = new \Nemundo\User\Data\User\UserExternalType($this, "process_content_user");
$this->user->tableName = "process_content";
$this->user->fieldName = "user";
$this->user->aliasFieldName = "process_content_user";
$this->user->label = "User";
}
return $this;
}
public function loadContentType() {
if ($this->contentType == null) {
$this->contentType = new \Nemundo\Process\Content\Data\ContentType\ContentTypeExternalType($this, "process_content_content_type");
$this->contentType->tableName = "process_content";
$this->contentType->fieldName = "content_type";
$this->contentType->aliasFieldName = "process_content_content_type";
$this->contentType->label = "Content Type";
}
return $this;
}
}