<?php
namespace Nemundo\Process\App\Share\Data\Share;
class ShareExternalType extends \Nemundo\Model\Type\External\ExternalType {
/**
* @var \Nemundo\Model\Type\Id\IdType
*/
public $id;

/**
* @var \Nemundo\Model\Type\Id\IdType
*/
public $toId;

/**
* @var \Nemundo\User\Data\User\UserExternalType
*/
public $to;

/**
* @var \Nemundo\Model\Type\Text\LargeTextType
*/
public $message;

protected function loadExternalType() {
parent::loadExternalType();
$this->externalModelClassName = ShareModel::class;
$this->externalTableName = "process_share";
$this->aliasTableName = $this->parentFieldName . "_" . $this->externalTableName;
$this->id = new \Nemundo\Model\Type\Id\IdType();
$this->id->fieldName = "id";
$this->id->tableName = $this->parentFieldName . "_" . $this->externalTableName;
$this->id->aliasFieldName = $this->id->tableName . "_" . $this->id->fieldName;
$this->id->label = "Id";
$this->addType($this->id);

$this->toId = new \Nemundo\Model\Type\Id\IdType();
$this->toId->fieldName = "to";
$this->toId->tableName = $this->parentFieldName . "_" . $this->externalTableName;
$this->toId->aliasFieldName = $this->toId->tableName ."_".$this->toId->fieldName;
$this->toId->label = "To";
$this->addType($this->toId);

$this->message = new \Nemundo\Model\Type\Text\LargeTextType();
$this->message->fieldName = "message";
$this->message->tableName = $this->parentFieldName . "_" . $this->externalTableName;
$this->message->aliasFieldName = $this->message->tableName . "_" . $this->message->fieldName;
$this->message->label = "Message";
$this->addType($this->message);

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