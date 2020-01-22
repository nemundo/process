<?php
namespace Nemundo\Process\App\Message\Data\MessageTo;
class MessageToExternalType extends \Nemundo\Model\Type\External\ExternalType {
/**
* @var \Nemundo\Model\Type\Id\IdType
*/
public $id;

/**
* @var \Nemundo\Model\Type\Id\IdType
*/
public $messageId;

/**
* @var \Nemundo\Process\App\Message\Data\Message\MessageExternalType
*/
public $message;

/**
* @var \Nemundo\Model\Type\Id\IdType
*/
public $toId;

/**
* @var \Nemundo\Process\Group\Data\Group\GroupExternalType
*/
public $to;

protected function loadExternalType() {
parent::loadExternalType();
$this->externalModelClassName = MessageToModel::class;
$this->externalTableName = "message_message_to";
$this->aliasTableName = $this->parentFieldName . "_" . $this->externalTableName;
$this->id = new \Nemundo\Model\Type\Id\IdType();
$this->id->fieldName = "id";
$this->id->tableName = $this->parentFieldName . "_" . $this->externalTableName;
$this->id->aliasFieldName = $this->id->tableName . "_" . $this->id->fieldName;
$this->id->label = "Id";
$this->addType($this->id);

$this->messageId = new \Nemundo\Model\Type\Id\IdType();
$this->messageId->fieldName = "message";
$this->messageId->tableName = $this->parentFieldName . "_" . $this->externalTableName;
$this->messageId->aliasFieldName = $this->messageId->tableName ."_".$this->messageId->fieldName;
$this->messageId->label = "Message";
$this->addType($this->messageId);

$this->toId = new \Nemundo\Model\Type\Id\IdType();
$this->toId->fieldName = "to";
$this->toId->tableName = $this->parentFieldName . "_" . $this->externalTableName;
$this->toId->aliasFieldName = $this->toId->tableName ."_".$this->toId->fieldName;
$this->toId->label = "To";
$this->addType($this->toId);

}
public function loadMessage() {
if ($this->message == null) {
$this->message = new \Nemundo\Process\App\Message\Data\Message\MessageExternalType(null, $this->parentFieldName . "_message");
$this->message->fieldName = "message";
$this->message->tableName = $this->parentFieldName . "_" . $this->externalTableName;
$this->message->aliasFieldName = $this->message->tableName ."_".$this->message->fieldName;
$this->message->label = "Message";
$this->addType($this->message);
}
return $this;
}
public function loadTo() {
if ($this->to == null) {
$this->to = new \Nemundo\Process\Group\Data\Group\GroupExternalType(null, $this->parentFieldName . "_to");
$this->to->fieldName = "to";
$this->to->tableName = $this->parentFieldName . "_" . $this->externalTableName;
$this->to->aliasFieldName = $this->to->tableName ."_".$this->to->fieldName;
$this->to->label = "To";
$this->addType($this->to);
}
return $this;
}
}