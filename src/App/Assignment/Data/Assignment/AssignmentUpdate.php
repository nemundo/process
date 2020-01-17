<?php
namespace Nemundo\Process\App\Assignment\Data\Assignment;
use Nemundo\Model\Data\AbstractModelUpdate;
class AssignmentUpdate extends AbstractModelUpdate {
/**
* @var AssignmentModel
*/
public $model;

/**
* @var string
*/
public $sourceId;

/**
* @var string
*/
public $groupId;

/**
* @var string
*/
public $message;

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
public $contentId;

public function __construct() {
parent::__construct();
$this->model = new AssignmentModel();
$this->deadline = new \Nemundo\Core\Type\DateTime\Date();
}
public function update() {
$this->typeValueList->setModelValue($this->model->sourceId, $this->sourceId);
$this->typeValueList->setModelValue($this->model->groupId, $this->groupId);
$this->typeValueList->setModelValue($this->model->message, $this->message);
$this->typeValueList->setModelValue($this->model->statusId, $this->statusId);
$property = new \Nemundo\Model\Data\Property\DateTime\DateDataProperty($this->model->deadline, $this->typeValueList);
$property->setValue($this->deadline);
$this->typeValueList->setModelValue($this->model->contentId, $this->contentId);
parent::update();
}
}