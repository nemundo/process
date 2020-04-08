<?php
namespace Nemundo\Process\App\Notification\Data\NotificationSource;
class NotificationSourceModel extends \Nemundo\Model\Definition\Model\AbstractModel {
/**
* @var \Nemundo\Model\Type\Id\IdType
*/
public $id;

protected function loadModel() {
$this->tableName = "process_notification_source";
$this->aliasTableName = "process_notification_source";
$this->label = "Notification Source";

$this->primaryIndex = new \Nemundo\Db\Index\AutoIncrementIdPrimaryIndex();

$this->id = new \Nemundo\Model\Type\Id\IdType($this);
$this->id->tableName = "process_notification_source";
$this->id->fieldName = "id";
$this->id->aliasFieldName = "process_notification_source_id";
$this->id->label = "Id";
$this->id->allowNullValue = false;
$this->id->visible->form = false;
$this->id->visible->table = false;
$this->id->visible->view = false;
$this->id->visible->form = false;

}
}