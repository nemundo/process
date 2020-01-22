<?php
namespace Nemundo\Process\App\Message\Data\MessageTo;
class MessageToModel extends \Nemundo\Model\Definition\Model\AbstractModel {
/**
* @var \Nemundo\Model\Type\Id\IdType
*/
public $id;

/**
* @var \Nemundo\Model\Type\External\Id\ExternalIdType
*/
public $messageId;

/**
* @var \Nemundo\Process\App\Message\Data\Message\MessageExternalType
*/
public $message;

/**
* @var \Nemundo\Model\Type\External\Id\ExternalUniqueIdType
*/
public $toId;

/**
* @var \Nemundo\Process\Group\Data\Group\GroupExternalType
*/
public $to;

protected function loadModel() {
$this->tableName = "message_message_to";
$this->aliasTableName = "message_message_to";
$this->label = "Message To";

$this->primaryIndex = new \Nemundo\Db\Index\AutoIncrementIdPrimaryIndex();

$this->id = new \Nemundo\Model\Type\Id\IdType($this);
$this->id->tableName = "message_message_to";
$this->id->fieldName = "id";
$this->id->aliasFieldName = "message_message_to_id";
$this->id->label = "Id";
$this->id->allowNullValue = false;
$this->id->visible->form = false;
$this->id->visible->table = false;
$this->id->visible->view = false;
$this->id->visible->form = false;

$this->messageId = new \Nemundo\Model\Type\External\Id\ExternalIdType($this);
$this->messageId->tableName = "message_message_to";
$this->messageId->fieldName = "message";
$this->messageId->aliasFieldName = "message_message_to_message";
$this->messageId->label = "Message";
$this->messageId->allowNullValue = false;

$this->toId = new \Nemundo\Model\Type\External\Id\ExternalUniqueIdType($this);
$this->toId->tableName = "message_message_to";
$this->toId->fieldName = "to";
$this->toId->aliasFieldName = "message_message_to_to";
$this->toId->label = "To";
$this->toId->allowNullValue = false;

}
public function loadMessage() {
if ($this->message == null) {
$this->message = new \Nemundo\Process\App\Message\Data\Message\MessageExternalType($this, "message_message_to_message");
$this->message->tableName = "message_message_to";
$this->message->fieldName = "message";
$this->message->aliasFieldName = "message_message_to_message";
$this->message->label = "Message";
}
return $this;
}
public function loadTo() {
if ($this->to == null) {
$this->to = new \Nemundo\Process\Group\Data\Group\GroupExternalType($this, "message_message_to_to");
$this->to->tableName = "message_message_to";
$this->to->fieldName = "to";
$this->to->aliasFieldName = "message_message_to_to";
$this->to->label = "To";
}
return $this;
}
}