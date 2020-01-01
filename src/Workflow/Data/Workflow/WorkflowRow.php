<?php
namespace Nemundo\Process\Workflow\Data\Workflow;
class WorkflowRow extends \Nemundo\Model\Row\AbstractModelDataRow {
/**
* @var \Nemundo\Model\Row\AbstractModelDataRow
*/
private $row;

/**
* @var WorkflowModel
*/
public $model;

/**
* @var string
*/
public $id;

/**
* @var int
*/
public $number;

/**
* @var string
*/
public $workflowNumber;

/**
* @var string
*/
public $subject;

/**
* @var string
*/
public $processId;

/**
* @var \Nemundo\Process\Content\Row\ContentTypeCustomRow
*/
public $process;

/**
* @var bool
*/
public $workflowClosed;

/**
* @var string
*/
public $statusId;

/**
* @var \Nemundo\Process\Content\Row\ContentTypeCustomRow
*/
public $status;

/**
* @var \Nemundo\Workflow\App\Identification\Model\Identification
*/
public $assignment;

/**
* @var \Nemundo\Core\Type\DateTime\Date
*/
public $deadline;

/**
* @var \Nemundo\Core\Type\DateTime\DateTime
*/
public $dateTime;

/**
* @var string
*/
public $userId;

/**
* @var \Nemundo\User\Data\User\UserRow
*/
public $user;

/**
* @var string
*/
public $groupAssignmentId;

/**
* @var \Nemundo\Process\Group\Data\Group\GroupRow
*/
public $groupAssignment;

public function __construct(\Nemundo\Db\Row\AbstractDataRow $row, $model) {
parent::__construct($row->getData());
$this->row = $row;
$this->id = $this->getModelValue($model->id);
$this->number = intval($this->getModelValue($model->number));
$this->workflowNumber = $this->getModelValue($model->workflowNumber);
$this->subject = $this->getModelValue($model->subject);
$this->processId = $this->getModelValue($model->processId);
if ($model->process !== null) {
$this->loadNemundoProcessContentDataContentTypeContentTypeprocessRow($model->process);
}
$this->workflowClosed = boolval($this->getModelValue($model->workflowClosed));
$this->statusId = $this->getModelValue($model->statusId);
if ($model->status !== null) {
$this->loadNemundoProcessContentDataContentTypeContentTypestatusRow($model->status);
}
$property = new \Nemundo\Workflow\App\Identification\Model\IdentificationReaderProperty($row, $model->assignment);
$this->assignment = $property->getValue();
$value = $this->getModelValue($model->deadline);
if ($value !== "0000-00-00") {
$this->deadline = new \Nemundo\Core\Type\DateTime\Date($this->getModelValue($model->deadline));
}
$this->dateTime = new \Nemundo\Core\Type\DateTime\DateTime($this->getModelValue($model->dateTime));
$this->userId = $this->getModelValue($model->userId);
if ($model->user !== null) {
$this->loadNemundoUserDataUserUseruserRow($model->user);
}
$this->groupAssignmentId = $this->getModelValue($model->groupAssignmentId);
if ($model->groupAssignment !== null) {
$this->loadNemundoProcessGroupDataGroupGroupgroupAssignmentRow($model->groupAssignment);
}
}
private function loadNemundoProcessContentDataContentTypeContentTypeprocessRow($model) {
$this->process = new \Nemundo\Process\Content\Row\ContentTypeCustomRow($this->row, $model);
}
private function loadNemundoProcessContentDataContentTypeContentTypestatusRow($model) {
$this->status = new \Nemundo\Process\Content\Row\ContentTypeCustomRow($this->row, $model);
}
private function loadNemundoUserDataUserUseruserRow($model) {
$this->user = new \Nemundo\User\Data\User\UserRow($this->row, $model);
}
private function loadNemundoProcessGroupDataGroupGroupgroupAssignmentRow($model) {
$this->groupAssignment = new \Nemundo\Process\Group\Data\Group\GroupRow($this->row, $model);
}
}