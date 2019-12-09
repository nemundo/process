<?php
namespace Nemundo\Process\Data\Workflow;
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
* @var \Nemundo\Process\Row\ProcessCustomRow
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
* @var \Nemundo\Process\Row\StatusCustomRow
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

public function __construct(\Nemundo\Db\Row\AbstractDataRow $row, $model) {
parent::__construct($row->getData());
$this->row = $row;
$this->id = $this->getModelValue($model->id);
$this->number = intval($this->getModelValue($model->number));
$this->workflowNumber = $this->getModelValue($model->workflowNumber);
$this->subject = $this->getModelValue($model->subject);
$this->processId = $this->getModelValue($model->processId);
if ($model->process !== null) {
$this->loadNemundoProcessDataProcessProcessprocessRow($model->process);
}
$this->workflowClosed = boolval($this->getModelValue($model->workflowClosed));
$this->statusId = $this->getModelValue($model->statusId);
if ($model->status !== null) {
$this->loadNemundoProcessDataStatusStatusstatusRow($model->status);
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
}
private function loadNemundoProcessDataProcessProcessprocessRow($model) {
$this->process = new \Nemundo\Process\Row\ProcessCustomRow($this->row, $model);
}
private function loadNemundoProcessDataStatusStatusstatusRow($model) {
$this->status = new \Nemundo\Process\Row\StatusCustomRow($this->row, $model);
}
private function loadNemundoUserDataUserUseruserRow($model) {
$this->user = new \Nemundo\User\Data\User\UserRow($this->row, $model);
}
}