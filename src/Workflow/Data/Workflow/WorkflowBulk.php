<?php
namespace Nemundo\Process\Workflow\Data\Workflow;
class WorkflowBulk extends \Nemundo\Model\Data\AbstractModelDataBulk {
/**
* @var WorkflowModel
*/
protected $model;

/**
* @var bool
*/
public $active;

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
* @var bool
*/
public $workflowClosed;

/**
* @var string
*/
public $statusId;

/**
* @var \Nemundo\Core\Type\DateTime\Date
*/
public $deadline;

/**
* @var string
*/
public $assignmentId;

/**
* @var string
*/
public $contentId;

public function __construct() {
parent::__construct();
$this->model = new WorkflowModel();
$this->deadline = new \Nemundo\Core\Type\DateTime\Date();
}
public function save() {
$this->typeValueList->setModelValue($this->model->active, $this->active);
$this->typeValueList->setModelValue($this->model->number, $this->number);
$this->typeValueList->setModelValue($this->model->workflowNumber, $this->workflowNumber);
$this->typeValueList->setModelValue($this->model->subject, $this->subject);
$this->typeValueList->setModelValue($this->model->workflowClosed, $this->workflowClosed);
$this->typeValueList->setModelValue($this->model->statusId, $this->statusId);
$property = new \Nemundo\Model\Data\Property\DateTime\DateDataProperty($this->model->deadline, $this->typeValueList);
$property->setValue($this->deadline);
$this->typeValueList->setModelValue($this->model->assignmentId, $this->assignmentId);
$this->typeValueList->setModelValue($this->model->contentId, $this->contentId);
$id = parent::save();
return $id;
}
}