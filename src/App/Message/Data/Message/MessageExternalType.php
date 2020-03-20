<?php
namespace Nemundo\Process\App\Message\Data\Message;
class MessageExternalType extends \Nemundo\Model\Type\External\ExternalType {
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
* @var \Nemundo\Model\Type\Id\IdType
*/
public $toId;

/**
* @var \Nemundo\User\Data\User\UserExternalType
*/
public $to;

protected function loadExternalType() {
parent::loadExternalType();
$this->externalModelClassName = MessageModel::class;
$this->externalTableName = "message_message";
$this->aliasTableName = $this->parentFieldName . "_" . $this->externalTableName;
$this->id = new \Nemundo\Model\Type\Id\IdType();
$this->id->fieldName = "id";
$this->id->tableName = $this->parentFieldName . "_" . $this->externalTableName;
$this->id->aliasFieldName = $this->id->tableName . "_" . $this->id->fieldName;
$this->id->label = "Id";
$this->addType($this->id);

$this->subject = new \Nemundo\Model\Type\Text\TextType();
$this->subject->fieldName = "subject";
$this->subject->tableName = $this->parentFieldName . "_" . $this->externalTableName;
$this->subject->aliasFieldName = $this->subject->tableName . "_" . $this->subject->fieldName;
$this->subject->label = "Subject";
$this->addType($this->subject);

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
}