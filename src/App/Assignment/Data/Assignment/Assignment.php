<?php
namespace Nemundo\Process\App\Assignment\Data\Assignment;
class Assignment extends \Nemundo\Model\Data\AbstractModelData {
/**
* @var AssignmentModel
*/
protected $model;

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
public function save() {
$this->typeValueList->setModelValue($this->model->sourceId, $this->sourceId);
$this->typeValueList->setModelValue($this->model->groupId, $this->groupId);
$this->typeValueList->setModelValue($this->model->message, $this->message);
$this->typeValueList->setModelValue($this->model->statusId, $this->statusId);
$property = new \Nemundo\Model\Data\Property\DateTime\DateDataProperty($this->model->deadline, $this->typeValueList);
$property->setValue($this->deadline);
$this->typeValueList->setModelValue($this->model->contentId, $this->contentId);
$id = parent::save();
return $id;
}
}