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
* @var \Nemundo\Model\Type\External\Id\ExternalIdType
*/
public $contentId;

/**
* @var \Nemundo\Process\Content\Data\Content\ContentExternalType
*/
public $content;

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
public $subjectContentId;

/**
* @var \Nemundo\Process\Content\Data\Content\ContentExternalType
*/
public $subjectContent;

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
$this->id->visible->form = false;
$this->id->visible->table = false;
$this->id->visible->view = false;
$this->id->visible->form = false;

$this->archive = new \Nemundo\Model\Type\Number\YesNoType($this);
$this->archive->tableName = "process_notification";
$this->archive->fieldName = "archive";
$this->archive->aliasFieldName = "process_notification_archive";
$this->archive->label = "Archive";
$this->archive->allowNullValue = false;

$this->contentId = new \Nemundo\Model\Type\External\Id\ExternalIdType($this);
$this->contentId->tableName = "process_notification";
$this->contentId->fieldName = "content";
$this->contentId->aliasFieldName = "process_notification_content";
$this->contentId->label = "Notification Content";
$this->contentId->allowNullValue = false;

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
$this->toId->allowNullValue = false;

$this->subjectContentId = new \Nemundo\Model\Type\External\Id\ExternalIdType($this);
$this->subjectContentId->tableName = "process_notification";
$this->subjectContentId->fieldName = "subject_content";
$this->subjectContentId->aliasFieldName = "process_notification_subject_content";
$this->subjectContentId->label = "Subject Content";
$this->subjectContentId->allowNullValue = false;

$index = new \Nemundo\Model\Definition\Index\ModelIndex($this);
$index->indexName = "user_archive";
$index->addType($this->toId);
$index->addType($this->archive);

}
public function loadContent() {
if ($this->content == null) {
$this->content = new \Nemundo\Process\Content\Data\Content\ContentExternalType($this, "process_notification_content");
$this->content->tableName = "process_notification";
$this->content->fieldName = "content";
$this->content->aliasFieldName = "process_notification_content";
$this->content->label = "Notification Content";
}
return $this;
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
public function loadSubjectContent() {
if ($this->subjectContent == null) {
$this->subjectContent = new \Nemundo\Process\Content\Data\Content\ContentExternalType($this, "process_notification_subject_content");
$this->subjectContent->tableName = "process_notification";
$this->subjectContent->fieldName = "subject_content";
$this->subjectContent->aliasFieldName = "process_notification_subject_content";
$this->subjectContent->label = "Subject Content";
}
return $this;
}
}