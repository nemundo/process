<?php
namespace Nemundo\Process\App\Message\Data\Message;
class MessageModel extends \Nemundo\Model\Definition\Model\AbstractModel {
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
public $message;

/**
* @var \Nemundo\Model\Type\External\Id\ExternalUniqueIdType
*/
public $toId;

/**
* @var \Nemundo\User\Data\User\UserExternalType
*/
public $to;

protected function loadModel() {
$this->tableName = "message_message";
$this->aliasTableName = "message_message";
$this->label = "Message";

$this->primaryIndex = new \Nemundo\Db\Index\AutoIncrementIdPrimaryIndex();

$this->id = new \Nemundo\Model\Type\Id\IdType($this);
$this->id->tableName = "message_message";
$this->id->fieldName = "id";
$this->id->aliasFieldName = "message_message_id";
$this->id->label = "Id";
$this->id->allowNullValue = false;
$this->id->visible->form = false;
$this->id->visible->table = false;
$this->id->visible->view = false;
$this->id->visible->form = false;

$this->subject = new \Nemundo\Model\Type\Text\TextType($this);
$this->subject->tableName = "message_message";
$this->subject->fieldName = "subject";
$this->subject->aliasFieldName = "message_message_subject";
$this->subject->label = "Subject";
$this->subject->allowNullValue = false;
$this->subject->length = 255;

$this->message = new \Nemundo\Model\Type\Text\LargeTextType($this);
$this->message->tableName = "message_message";
$this->message->fieldName = "message";
$this->message->aliasFieldName = "message_message_message";
$this->message->label = "Message";
$this->message->allowNullValue = false;

$this->toId = new \Nemundo\Model\Type\External\Id\ExternalUniqueIdType($this);
$this->toId->tableName = "message_message";
$this->toId->fieldName = "to";
$this->toId->aliasFieldName = "message_message_to";
$this->toId->label = "To";
$this->toId->allowNullValue = false;

}
public function loadTo() {
if ($this->to == null) {
$this->to = new \Nemundo\User\Data\User\UserExternalType($this, "message_message_to");
$this->to->tableName = "message_message";
$this->to->fieldName = "to";
$this->to->aliasFieldName = "message_message_to";
$this->to->label = "To";
}
return $this;
}
}