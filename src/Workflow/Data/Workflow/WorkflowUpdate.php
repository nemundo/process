<?php
namespace Nemundo\Process\Workflow\Data\Workflow;
use Nemundo\Model\Data\AbstractModelUpdate;
class WorkflowUpdate extends AbstractModelUpdate {
/**
* @var WorkflowModel
*/
public $model;

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
* @var bool
*/
public $workflowClosed;

/**
* @var string
*/
public $statusId;

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
* @var string
*/
public $groupAssignmentId;

public function __construct() {
parent::__construct();
$this->model = new WorkflowModel();
$this->assignment = new \Nemundo\Workflow\App\Identification\Model\Identification();
$this->deadline = new \Nemundo\Core\Type\DateTime\Date();
$this->dateTime = new \Nemundo\Core\Type\DateTime\DateTime();
}
public function update() {
$this->typeValueList->setModelValue($this->model->number, $this->number);
$this->typeValueList->setModelValue($this->model->workflowNumber, $this->workflowNumber);
$this->typeValueList->setModelValue($this->model->subject, $this->subject);
$this->typeValueList->setModelValue($this->model->processId, $this->processId);
$this->typeValueList->setModelValue($this->model->workflowClosed, $this->workflowClosed);
$this->typeValueList->setModelValue($this->model->statusId, $this->statusId);
$property = new \Nemundo\Workflow\App\Identification\Model\IdentificationDataProperty($this->model->assignment, $this->typeValueList);
$property->setValue($this->assignment);
$property = new \Nemundo\Model\Data\Property\DateTime\DateDataProperty($this->model->deadline, $this->typeValueList);
$property->setValue($this->deadline);
$property = new \Nemundo\Model\Data\Property\DateTime\DateTimeDataProperty($this->model->dateTime, $this->typeValueList);
$property->setValue($this->dateTime);
$this->typeValueList->setModelValue($this->model->userId, $this->userId);
$this->typeValueList->setModelValue($this->model->groupAssignmentId, $this->groupAssignmentId);
parent::update();
}
}