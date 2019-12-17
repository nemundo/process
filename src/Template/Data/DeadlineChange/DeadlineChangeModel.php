<?php
namespace Nemundo\Process\Template\Data\DeadlineChange;
class DeadlineChangeModel extends \Nemundo\Model\Definition\Model\AbstractModel {
/**
* @var \Nemundo\Model\Type\Id\IdType
*/
public $id;

/**
* @var \Nemundo\Model\Type\DateTime\DateType
*/
public $deadline;

protected function loadModel() {
$this->tableName = "template_deadline_change";
$this->aliasTableName = "template_deadline_change";
$this->label = "Deadline Change";

$this->primaryIndex = new \Nemundo\Db\Index\TextIdPrimaryIndex();

$this->id = new \Nemundo\Model\Type\Id\IdType($this);
$this->id->tableName = "template_deadline_change";
$this->id->fieldName = "id";
$this->id->aliasFieldName = "template_deadline_change_id";
$this->id->label = "Id";
$this->id->allowNullValue = false;
$this->id->visible->form = false;
$this->id->visible->table = false;
$this->id->visible->view = false;
$this->id->visible->form = false;

$this->deadline = new \Nemundo\Model\Type\DateTime\DateType($this);
$this->deadline->tableName = "template_deadline_change";
$this->deadline->fieldName = "deadline";
$this->deadline->aliasFieldName = "template_deadline_change_deadline";
$this->deadline->label = "Deadline";
$this->deadline->allowNullValue = false;

}
}