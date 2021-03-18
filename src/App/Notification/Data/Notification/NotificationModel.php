<?php
namespace Nemundo\Process\App\Notification\Data\Notification;
class NotificationModel extends \Nemundo\Model\Definition\Model\AbstractModel {
/**
* @var \Nemundo\Model\Type\Id\IdType
*/
public $id;

/**
* @var \Nemundo\Model\Type\Number\YesNoType
*/
public $archive;

/**
* @var \Nemundo\Model\Type\Text\LargeTextType
*/
public $message;

/**
* @var \Nemundo\Model\Type\External\Id\ExternalUniqueIdType
*/
public $toId;

/**
* @var \Nemundo\User\Data\User\UserExternalType
*/
public $to;

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
public $subject;

/**
* @var \Nemundo\Model\Type\Number\YesNoType
*/
public $read;

/**
* @var \Nemundo\Model\Type\External\Id\ExternalUniqueIdType
*/
public $contentTypeId;

/**
* @var \Nemundo\Process\Content\Data\ContentType\ContentTypeExternalType
*/
public $contentType;

/**
* @var \Nemundo\Model\Type\External\Id\ExternalIdType
*/
public $sourceId;

/**
* @var \Nemundo\Process\Content\Data\Content\ContentExternalType
*/
public $source;

/**
* @var \Nemundo\Model\Type\External\Id\ExternalIdType
*/
public $categoryId;

/**
* @var \Nemundo\Process\App\Notification\Data\Category\CategoryExternalType
*/
public $category;

protected function loadModel() {
$this->tableName = "process_notification";
$this->aliasTableName = "process_notification";
$this->label = "Notification";

$this->primaryIndex = new \Nemundo\Db\Index\AutoIncrementIdPrimaryIndex();

$this->id = new \Nemundo\Model\Type\Id\IdType($this);
$this->id->tableName = "process_notification";
$this->id->fieldName = "id";
$this->id->aliasFieldName = "process_notification_id";
$this->id->label = "Id";
$this->id->allowNullValue = false;

$this->archive = new \Nemundo\Model\Type\Number\YesNoType($this);
$this->archive->tableName = "process_notification";
$this->archive->fieldName = "archive";
$this->archive->aliasFieldName = "process_notification_archive";
$this->archive->label = "Archive";
$this->archive->allowNullValue = false;

$this->message = new \Nemundo\Model\Type\Text\LargeTextType($this);
$this->message->tableName = "process_notification";
$this->message->fieldName = "message";
$this->message->aliasFieldName = "process_notification_message";
$this->message->label = "Message";
$this->message->allowNullValue = false;

$this->toId = new \Nemundo\Model\Type\External\Id\ExternalUniqueIdType($this);
$this->toId->tableName = "process_notification";
$this->toId->fieldName = "to";
$this->toId->aliasFieldName = "process_notification_to";
$this->toId->label = "To";
$this->toId->allowNullValue = true;

$this->contentId = new \Nemundo\Model\Type\External\Id\ExternalIdType($this);
$this->contentId->tableName = "process_notification";
$this->contentId->fieldName = "content";
$this->contentId->aliasFieldName = "process_notification_content";
$this->contentId->label = "Content";
$this->contentId->allowNullValue = false;

$this->subject = new \Nemundo\Model\Type\Text\TextType($this);
$this->subject->tableName = "process_notification";
$this->subject->fieldName = "subject";
$this->subject->aliasFieldName = "process_notification_subject";
$this->subject->label = "Subject";
$this->subject->allowNullValue = false;
$this->subject->length = 255;

$this->read = new \Nemundo\Model\Type\Number\YesNoType($this);
$this->read->tableName = "process_notification";
$this->read->fieldName = "read";
$this->read->aliasFieldName = "process_notification_read";
$this->read->label = "Read";
$this->read->allowNullValue = false;

$this->contentTypeId = new \Nemundo\Model\Type\External\Id\ExternalUniqueIdType($this);
$this->contentTypeId->tableName = "process_notification";
$this->contentTypeId->fieldName = "content_type";
$this->contentTypeId->aliasFieldName = "process_notification_content_type";
$this->contentTypeId->label = "Content Type";
$this->contentTypeId->allowNullValue = false;

$this->sourceId = new \Nemundo\Model\Type\External\Id\ExternalIdType($this);
$this->sourceId->tableName = "process_notification";
$this->sourceId->fieldName = "source";
$this->sourceId->aliasFieldName = "process_notification_source";
$this->sourceId->label = "Source";
$this->sourceId->allowNullValue = false;

$this->categoryId = new \Nemundo\Model\Type\External\Id\ExternalIdType($this);
$this->categoryId->tableName = "process_notification";
$this->categoryId->fieldName = "category";
$this->categoryId->aliasFieldName = "process_notification_category";
$this->categoryId->label = "Category";
$this->categoryId->allowNullValue = false;

$index = new \Nemundo\Model\Definition\Index\ModelIndex($this);
$index->indexName = "user_archive";
$index->addType($this->toId);
$index->addType($this->archive);

$index = new \Nemundo\Model\Definition\Index\ModelUniqueIndex($this);
$index->indexName = "to_content";
$index->addType($this->toId);
$index->addType($this->contentId);

}
public function loadTo() {
if ($this->to == null) {
$this->to = new \Nemundo\User\Data\User\UserExternalType($this, "process_notification_to");
$this->to->tableName = "process_notification";
$this->to->fieldName = "to";
$this->to->aliasFieldName = "process_notification_to";
$this->to->label = "To";
}
return $this;
}
public function loadContent() {
if ($this->content == null) {
$this->content = new \Nemundo\Process\Content\Data\Content\ContentExternalType($this, "process_notification_content");
$this->content->tableName = "process_notification";
$this->content->fieldName = "content";
$this->content->aliasFieldName = "process_notification_content";
$this->content->label = "Content";
}
return $this;
}
public function loadContentType() {
if ($this->contentType == null) {
$this->contentType = new \Nemundo\Process\Content\Data\ContentType\ContentTypeExternalType($this, "process_notification_content_type");
$this->contentType->tableName = "process_notification";
$this->contentType->fieldName = "content_type";
$this->contentType->aliasFieldName = "process_notification_content_type";
$this->contentType->label = "Content Type";
}
return $this;
}
public function loadSource() {
if ($this->source == null) {
$this->source = new \Nemundo\Process\Content\Data\Content\ContentExternalType($this, "process_notification_source");
$this->source->tableName = "process_notification";
$this->source->fieldName = "source";
$this->source->aliasFieldName = "process_notification_source";
$this->source->label = "Source";
}
return $this;
}
public function loadCategory() {
if ($this->category == null) {
$this->category = new \Nemundo\Process\App\Notification\Data\Category\CategoryExternalType($this, "process_notification_category");
$this->category->tableName = "process_notification";
$this->category->fieldName = "category";
$this->category->aliasFieldName = "process_notification_category";
$this->category->label = "Category";
}
return $this;
}
}