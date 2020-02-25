<?php
namespace Nemundo\Process\App\Assignment\Data\AssignmentLog;
class AssignmentLogModel extends \Nemundo\Model\Definition\Model\AbstractModel {
/**
* @var \Nemundo\Model\Type\Id\IdType
*/
public $id;

/**
* @var \Nemundo\Model\Type\External\Id\ExternalUniqueIdType
*/
public $assignmentId;

/**
* @var \Nemundo\Process\Group\Data\Group\GroupExternalType
*/
public $assignment;

protected function loadModel() {
$this->tableName = "assignment_assignment_log";
$this->aliasTableName = "assignment_assignment_log";
$this->label = "Assignment Log";

$this->primaryIndex = new \Nemundo\Db\Index\AutoIncrementIdPrimaryIndex();

$this->id = new \Nemundo\Model\Type\Id\IdType($this);
$this->id->tableName = "assignment_assignment_log";
$this->id->fieldName = "id";
$this->id->aliasFieldName = "assignment_assignment_log_id";
$this->id->label = "Id";
$this->id->allowNullValue = false;
$this->id->visible->form = false;
$this->id->visible->table = false;
$this->id->visible->view = false;
$this->id->visible->form = false;

$this->assignmentId = new \Nemundo\Model\Type\External\Id\ExternalUniqueIdType($this);
$this->assignmentId->tableName = "assignment_assignment_log";
$this->assignmentId->fieldName = "assignment";
$this->assignmentId->aliasFieldName = "assignment_assignment_log_assignment";
$this->assignmentId->label = "Assignment";
$this->assignmentId->allowNullValue = false;

}
public function loadAssignment() {
if ($this->assignment == null) {
$this->assignment = new \Nemundo\Process\Group\Data\Group\GroupExternalType($this, "assignment_assignment_log_assignment");
$this->assignment->tableName = "assignment_assignment_log";
$this->assignment->fieldName = "assignment";
$this->assignment->aliasFieldName = "assignment_assignment_log_assignment";
$this->assignment->label = "Assignment";
}
return $this;
}
}