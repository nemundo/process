<?php
namespace Nemundo\Process\Data\Status;
class StatusModel extends \Nemundo\Model\Definition\Model\AbstractModel {
/**
* @var \Nemundo\Model\Type\Id\IdType
*/
public $id;

/**
* @var \Nemundo\Model\Type\Text\TextType
*/
public $statusLabel;

/**
* @var \Nemundo\Model\Type\Text\TextType
*/
public $statusClass;

protected function loadModel() {
$this->tableName = "process_status";
$this->aliasTableName = "process_status";
$this->label = "Status";

$this->primaryIndex = new \Nemundo\Db\Index\UniqueIdPrimaryIndex();

$this->id = new \Nemundo\Model\Type\Id\IdType($this);
$this->id->tableName = "process_status";
$this->id->fieldName = "id";
$this->id->aliasFieldName = "process_status_id";
$this->id->label = "Id";
$this->id->allowNullValue = false;
$this->id->visible->form = false;
$this->id->visible->table = false;
$this->id->visible->view = false;
$this->id->visible->form = false;

$this->statusLabel = new \Nemundo\Model\Type\Text\TextType($this);
$this->statusLabel->tableName = "process_status";
$this->statusLabel->fieldName = "status_label";
$this->statusLabel->aliasFieldName = "process_status_status_label";
$this->statusLabel->label = "Status Label";
$this->statusLabel->allowNullValue = false;
$this->statusLabel->length = 255;

$this->statusClass = new \Nemundo\Model\Type\Text\TextType($this);
$this->statusClass->tableName = "process_status";
$this->statusClass->fieldName = "status_class";
$this->statusClass->aliasFieldName = "process_status_status_class";
$this->statusClass->label = "Status Class";
$this->statusClass->allowNullValue = false;
$this->statusClass->length = 255;

}
}