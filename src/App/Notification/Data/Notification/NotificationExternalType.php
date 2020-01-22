<?php
namespace Nemundo\Process\App\Notification\Data\Notification;
class NotificationExternalType extends \Nemundo\Model\Type\External\ExternalType {
/**
* @var \Nemundo\Model\Type\Id\IdType
*/
public $id;

/**
* @var \Nemundo\Model\Type\Number\YesNoType
*/
public $archive;

/**
* @var \Nemundo\Model\Type\Id\IdType
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
* @var \Nemundo\Model\Type\Id\IdType
*/
public $toId;

/**
* @var \Nemundo\User\Data\User\UserExternalType
*/
public $to;

/**
* @var \Nemundo\Model\Type\Id\IdType
*/
public $subjectContentId;

/**
* @var \Nemundo\Process\Content\Data\Content\ContentExternalType
*/
public $subjectContent;

protected function loadExternalType() {
parent::loadExternalType();
$this->externalModelClassName = NotificationModel::class;
$this->externalTableName = "process_notification";
$this->aliasTableName = $this->parentFieldName . "_" . $this->externalTableName;
$this->id = new \Nemundo\Model\Type\Id\IdType();
$this->id->fieldName = "id";
$this->id->tableName = $this->parentFieldName . "_" . $this->externalTableName;
$this->id->aliasFieldName = $this->id->tableName . "_" . $this->id->fieldName;
$this->id->label = "Id";
$this->addType($this->id);

$this->archive = new \Nemundo\Model\Type\Number\YesNoType();
$this->archive->fieldName = "archive";
$this->archive->tableName = $this->parentFieldName . "_" . $this->externalTableName;
$this->archive->aliasFieldName = $this->archive->tableName . "_" . $this->archive->fieldName;
$this->archive->label = "Archive";
$this->addType($this->archive);

$this->contentId = new \Nemundo\Model\Type\Id\IdType();
$this->contentId->fieldName = "content";
$this->contentId->tableName = $this->parentFieldName . "_" . $this->externalTableName;
$this->contentId->aliasFieldName = $this->contentId->tableName ."_".$this->contentId->fieldName;
$this->contentId->label = "Content";
$this->addType($this->contentId);

$this->message = new \Nemundo\Model\Type\Text\LargeTextType();
$this->message->fieldName = "message";
$this->message->tableName = $this->parentFieldName . "_" . $this->externalTableName;
$this->message->aliasFieldName = $this->message->tableName . "_" . $this->message->fieldName;
$this->message->label = "Message";
$this->addType($this->message);

$this->toId = new \Nemundo\Model\Type\Id\IdType();
$this->toId->fieldName = "to";
$this->toId->tableName = $this->parentFieldName . "_" . $this->externalTableName;
$this->toId->aliasFieldName = $this->toId->tableName ."_".$this->toId->fieldName;
$this->toId->label = "To";
$this->addType($this->toId);

$this->subjectContentId = new \Nemundo\Model\Type\Id\IdType();
$this->subjectContentId->fieldName = "subject_content";
$this->subjectContentId->tableName = $this->parentFieldName . "_" . $this->externalTableName;
$this->subjectContentId->aliasFieldName = $this->subjectContentId->tableName ."_".$this->subjectContentId->fieldName;
$this->subjectContentId->label = "Subject Content";
$this->addType($this->subjectContentId);

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
public function loadTo() {
if ($this->to == null) {
$this->to = new \Nemundo\User\Data\User\UserExternalType(null, $this->parentFieldName . "_to");
$this->to->fieldName = "to";
$this->to->tableName = $this->parentFieldName . "_" . $this->externalTableName;
$this->to->aliasFieldName = $this->to->tableName ."_".$this->to->fieldName;
$this->to->label = "To";
$this->addType($this->to);
}
return $this;
}
public function loadSubjectContent() {
if ($this->subjectContent == null) {
$this->subjectContent = new \Nemundo\Process\Content\Data\Content\ContentExternalType(null, $this->parentFieldName . "_subject_content");
$this->subjectContent->fieldName = "subject_content";
$this->subjectContent->tableName = $this->parentFieldName . "_" . $this->externalTableName;
$this->subjectContent->aliasFieldName = $this->subjectContent->tableName ."_".$this->subjectContent->fieldName;
$this->subjectContent->label = "Subject Content";
$this->addType($this->subjectContent);
}
return $this;
}
}