<?php
namespace Nemundo\Process\App\Assignment\Data\MessageAssignment;
class MessageAssignmentModel extends \Nemundo\Model\Definition\Model\AbstractModel {
/**
* @var \Nemundo\Model\Type\Id\IdType
*/
public $id;

/**
* @var \Nemundo\Model\Type\Text\LargeTextType
*/
public $message;

protected function loadModel() {
$this->tableName = "assignment_message_assignment";
$this->aliasTableName = "assignment_message_assignment";
$this->label = "Message Assignment";

$this->primaryIndex = new \Nemundo\Db\Index\AutoIncrementIdPrimaryIndex();

$this->id = new \Nemundo\Model\Type\Id\IdType($this);
$this->id->tableName = "assignment_message_assignment";
$this->id->fieldName = "id";
$this->id->aliasFieldName = "assignment_message_assignment_id";
$this->id->label = "Id";
$this->id->allowNullValue = false;
$this->id->visible->form = false;
$this->id->visible->table = false;
$this->id->visible->view = false;
$this->id->visible->form = false;

$this->message = new \Nemundo\Model\Type\Text\LargeTextType($this);
$this->message->tableName = "assignment_message_assignment";
$this->message->fieldName = "message";
$this->message->aliasFieldName = "assignment_message_assignment_message";
$this->message->label = "Message";
$this->message->allowNullValue = false;

}
}