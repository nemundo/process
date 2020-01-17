<?php
namespace Nemundo\Process\App\Assignment\Data\AssignmentStatus;
class AssignmentStatusModel extends \Nemundo\Model\Definition\Model\AbstractModel {
/**
* @var \Nemundo\Model\Type\Id\IdType
*/
public $id;

/**
* @var \Nemundo\Model\Type\Text\TextType
*/
public $status;

protected function loadModel() {
$this->tableName = "process_assignment_status";
$this->aliasTableName = "process_assignment_status";
$this->label = "AssignmentStatus";

$this->primaryIndex = new \Nemundo\Db\Index\NumberIdPrimaryIndex();

$this->id = new \Nemundo\Model\Type\Id\IdType($this);
$this->id->tableName = "process_assignment_status";
$this->id->fieldName = "id";
$this->id->aliasFieldName = "process_assignment_status_id";
$this->id->label = "Id";
$this->id->allowNullValue = false;
$this->id->visible->form = false;
$this->id->visible->table = false;
$this->id->visible->view = false;
$this->id->visible->form = false;

$this->status = new \Nemundo\Model\Type\Text\TextType($this);
$this->status->tableName = "process_assignment_status";
$this->status->fieldName = "status";
$this->status->aliasFieldName = "process_assignment_status_status";
$this->status->label = "Status";
$this->status->allowNullValue = false;
$this->status->length = 255;

}
}