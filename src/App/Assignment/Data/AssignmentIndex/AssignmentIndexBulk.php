<?php
namespace Nemundo\Process\App\Assignment\Data\AssignmentIndex;
class AssignmentIndexBulk extends \Nemundo\Model\Data\AbstractModelDataBulk {
/**
* @var AssignmentIndexModel
*/
protected $model;

/**
* @var string
*/
public $sourceId;

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
* @var bool
*/
public $closed;

/**
* @var string
*/
public $contentId;

public function __construct() {
parent::__construct();
$this->model = new AssignmentIndexModel();
$this->deadline = new \Nemundo\Core\Type\DateTime\Date();
}
public function save() {
$this->typeValueList->setModelValue($this->model->sourceId, $this->sourceId);
$this->typeValueList->setModelValue($this->model->subject, $this->subject);
$this->typeValueList->setModelValue($this->model->assignmentId, $this->assignmentId);
$property = new \Nemundo\Model\Data\Property\DateTime\DateDataProperty($this->model->deadline, $this->typeValueList);
$property->setValue($this->deadline);
$this->typeValueList->setModelValue($this->model->closed, $this->closed);
$this->typeValueList->setModelValue($this->model->contentId, $this->contentId);
$id = parent::save();
return $id;
}
}