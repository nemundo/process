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

/**
* @var \Nemundo\Model\Type\External\Id\ExternalUniqueIdType
*/
public $contentTypeId;

/**
* @var \Nemundo\Process\Content\Data\ContentType\ContentTypeExternalType
*/
public $contentType;

protected function loadModel() {
$this->tableName = "content2_content";
$this->aliasTableName = "content2_content";
$this->label = "Content";

$this->primaryIndex = new \Nemundo\Db\Index\TextIdPrimaryIndex();

$this->id = new \Nemundo\Model\Type\Id\IdType($this);
$this->id->tableName = "content2_content";
$this->id->fieldName = "id";
$this->id->aliasFieldName = "content2_content_id";
$this->id->label = "Id";
$this->id->allowNullValue = false;
$this->id->visible->form = false;
$this->id->visible->table = false;
$this->id->visible->view = false;
$this->id->visible->form = false;

$this->subject = new \Nemundo\Model\Type\Text\TextType($this);
$this->subject->tableName = "content2_content";
$this->subject->fieldName = "subject";
$this->subject->aliasFieldName = "content2_content_subject";
$this->subject->label = "Subject";
$this->subject->allowNullValue = false;
$this->subject->length = 255;

$this->text = new \Nemundo\Model\Type\Text\LargeTextType($this);
$this->text->tableName = "content2_content";
$this->text->fieldName = "text";
$this->text->aliasFieldName = "content2_content_text";
$this->text->label = "Text";
$this->text->allowNullValue = false;

$this->dateTime = new \Nemundo\Model\Type\DateTime\DateTimeType($this);
$this->dateTime->tableName = "content2_content";
$this->dateTime->fieldName = "date_time";
$this->dateTime->aliasFieldName = "content2_content_date_time";
$this->dateTime->label = "Date Time";
$this->dateTime->allowNullValue = false;

$this->userId = new \Nemundo\Model\Type\External\Id\ExternalUniqueIdType($this);
$this->userId->tableName = "content2_content";
$this->userId->fieldName = "user";
$this->userId->aliasFieldName = "content2_content_user";
$this->userId->label = "User";
$this->userId->allowNullValue = false;

$this->contentTypeId = new \Nemundo\Model\Type\External\Id\ExternalUniqueIdType($this);
$this->contentTypeId->tableName = "content2_content";
$this->contentTypeId->fieldName = "content_type";
$this->contentTypeId->aliasFieldName = "content2_content_content_type";
$this->contentTypeId->label = "Content Type";
$this->contentTypeId->allowNullValue = false;

$index = new \Nemundo\Model\Definition\Index\ModelIndex($this);
$index->indexName = "content_type";

$index = new \Nemundo\Model\Definition\Index\ModelIndex($this);
$index->indexName = "date_time";

}
public function loadUser() {
if ($this->user == null) {
$this->user = new \Nemundo\User\Data\User\UserExternalType($this, "content2_content_user");
$this->user->tableName = "content2_content";
$this->user->fieldName = "user";
$this->user->aliasFieldName = "content2_content_user";
$this->user->label = "User";
}
return $this;
}
public function loadContentType() {
if ($this->contentType == null) {
$this->contentType = new \Nemundo\Process\Content\Data\ContentType\ContentTypeExternalType($this, "content2_content_content_type");
$this->contentType->tableName = "content2_content";
$this->contentType->fieldName = "content_type";
$this->contentType->aliasFieldName = "content2_content_content_type";
$this->contentType->label = "Content Type";
}
return $this;
}
}