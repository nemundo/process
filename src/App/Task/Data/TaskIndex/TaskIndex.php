<?php
namespace Nemundo\Process\App\Task\Data\TaskIndex;
class TaskIndex extends \Nemundo\Model\Data\AbstractModelData {
/**
* @var TaskIndexModel
*/
protected $model;

/**
* @var string
*/
public $sourceId;

/**
* @var string
*/
public $contentId;

/**
* @var string
*/
public $subject;

/**
* @var string
*/
public $assignmentId;

/**
* @var \Nemundo\Core\Type\DateTime\Date
*/
public $deadline;

/**
* @var string
*/
public $userId;

/**
* @var \Nemundo\Core\Type\DateTime\DateTime
*/
public $dateTime;

/**
* @var bool
*/
public $closed;

/**
* @var string
*/
public $taskTypeId;

/**
* @var bool
*/
public $updateStatus;

public function __construct() {
parent::__construct();
$this->model = new TaskIndexModel();
$this->deadline = new \Nemundo\Core\Type\DateTime\Date();
$this->dateTime = new \Nemundo\Core\Type\DateTime\DateTime();
}
public function save() {
$this->typeValueList->setModelValue($this->model->sourceId, $this->sourceId);
$this->typeValueList->setModelValue($this->model->contentId, $this->contentId);
$this->typeValueList->setModelValue($this->model->subject, $this->subject);
$this->typeValueList->setModelValue($this->model->assignmentId, $this->assignmentId);
$property = new \Nemundo\Model\Data\Property\DateTime\DateDataProperty($this->model->deadline, $this->typeValueList);
$property->setValue($this->deadline);
$this->typeValueList->setModelValue($this->model->userId, $this->userId);
$property = new \Nemundo\Model\Data\Property\DateTime\DateTimeDataProperty($this->model->dateTime, $this->typeValueList);
$property->setValue($this->dateTime);
$this->typeValueList->setModelValue($this->model->closed, $this->closed);
$this->typeValueList->setModelValue($this->model->taskTypeId, $this->taskTypeId);
$this->typeValueList->setModelValue($this->model->updateStatus, $this->updateStatus);
$id = parent::save();
return $id;
}
}