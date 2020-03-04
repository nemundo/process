<?php
namespace Nemundo\Process\App\Task\Data\Task;
class TaskRow extends \Nemundo\Model\Row\AbstractModelDataRow {
/**
* @var \Nemundo\Model\Row\AbstractModelDataRow
*/
private $row;

/**
* @var TaskModel
*/
public $model;

/**
* @var string
*/
public $id;

/**
* @var int
*/
public $sourceId;

/**
* @var \Nemundo\Process\Content\Row\ContentCustomRow
*/
public $source;

/**
* @var string
*/
public $assignmentId;

/**
* @var \Nemundo\Process\Group\Row\GroupCustomRow
*/
public $assignment;

/**
* @var \Nemundo\Core\Type\DateTime\Date
*/
public $deadline;

/**
* @var string
*/
public $task;

/**
* @var bool
*/
public $closed;

public function __construct(\Nemundo\Db\Row\AbstractDataRow $row, $model) {
parent::__construct($row->getData());
$this->row = $row;
$this->id = $this->getModelValue($model->id);
$this->sourceId = intval($this->getModelValue($model->sourceId));
if ($model->source !== null) {
$this->loadNemundoProcessContentDataContentContentsourceRow($model->source);
}
$this->assignmentId = $this->getModelValue($model->assignmentId);
if ($model->assignment !== null) {
$this->loadNemundoProcessGroupDataGroupGroupassignmentRow($model->assignment);
}
$value = $this->getModelValue($model->deadline);
if ($value !== "0000-00-00") {
$this->deadline = new \Nemundo\Core\Type\DateTime\Date($this->getModelValue($model->deadline));
}
$this->task = $this->getModelValue($model->task);
$this->closed = boolval($this->getModelValue($model->closed));
}
private function loadNemundoProcessContentDataContentContentsourceRow($model) {
$this->source = new \Nemundo\Process\Content\Row\ContentCustomRow($this->row, $model);
}
private function loadNemundoProcessGroupDataGroupGroupassignmentRow($model) {
$this->assignment = new \Nemundo\Process\Group\Row\GroupCustomRow($this->row, $model);
}
}