<?php
namespace Nemundo\Process\App\Share\Data\Share;
class ShareModel extends \Nemundo\Model\Definition\Model\AbstractModel {
/**
* @var \Nemundo\Model\Type\Id\IdType
*/
public $id;

/**
* @var \Nemundo\Model\Type\External\Id\ExternalUniqueIdType
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

protected function loadModel() {
$this->tableName = "process_share";
$this->aliasTableName = "process_share";
$this->label = "Share";

$this->primaryIndex = new \Nemundo\Db\Index\AutoIncrementIdPrimaryIndex();

$this->id = new \Nemundo\Model\Type\Id\IdType($this);
$this->id->tableName = "process_share";
$this->id->fieldName = "id";
$this->id->aliasFieldName = "process_share_id";
$this->id->label = "Id";
$this->id->allowNullValue = false;

$this->toId = new \Nemundo\Model\Type\External\Id\ExternalUniqueIdType($this);
$this->toId->tableName = "process_share";
$this->toId->fieldName = "to";
$this->toId->aliasFieldName = "process_share_to";
$this->toId->label = "To";
$this->toId->allowNullValue = false;

$this->message = new \Nemundo\Model\Type\Text\LargeTextType($this);
$this->message->tableName = "process_share";
$this->message->fieldName = "message";
$this->message->aliasFieldName = "process_share_message";
$this->message->label = "Message";
$this->message->allowNullValue = false;

}
public function loadTo() {
if ($this->to == null) {
$this->to = new \Nemundo\User\Data\User\UserExternalType($this, "process_share_to");
$this->to->tableName = "process_share";
$this->to->fieldName = "to";
$this->to->aliasFieldName = "process_share_to";
$this->to->label = "To";
}
return $this;
}
}