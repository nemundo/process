<?php
namespace Nemundo\Process\App\Assignment\Data\Assignment;
class AssignmentRow extends \Nemundo\Model\Row\AbstractModelDataRow {
/**
* @var \Nemundo\Model\Row\AbstractModelDataRow
*/
private $row;

/**
* @var AssignmentModel
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
public $groupId;

/**
* @var \Nemundo\Process\Group\Data\Group\GroupRow
*/
public $group;

/**
* @var string
*/
public $message;

/**
* @var int
*/
public $statusId;

/**
* @var \Nemundo\Process\App\Assignment\Data\AssignmentStatus\AssignmentStatusRow
*/
public $status;

/**
* @var \Nemundo\Core\Type\DateTime\Date
*/
public $deadline;

/**
* @var int
*/
public $contentId;

/**
* @var \Nemundo\Process\Content\Row\ContentCustomRow
*/
public $content;

public function __construct(\Nemundo\Db\Row\AbstractDataRow $row, $model) {
parent::__construct($row->getData());
$this->row = $row;
$this->id = $this->getModelValue($model->id);
$this->sourceId = intval($this->getModelValue($model->sourceId));
if ($model->source !== null) {
$this->loadNemundoProcessContentDataContentContentsourceRow($model->source);
}
$this->groupId = $this->getModelValue($model->groupId);
if ($model->group !== null) {
$this->loadNemundoProcessGroupDataGroupGroupgroupRow($model->group);
}
$this->message = $this->getModelValue($model->message);
$this->statusId = intval($this->getModelValue($model->statusId));
if ($model->status !== null) {
$this->loadNemundoProcessAppAssignmentDataAssignmentStatusAssignmentStatusstatusRow($model->status);
}
$value = $this->getModelValue($model->deadline);
if ($value !== "0000-00-00") {
$this->deadline = new \Nemundo\Core\Type\DateTime\Date($this->getModelValue($model->deadline));
}
$this->contentId = intval($this->getModelValue($model->contentId));
if ($model->content !== null) {
$this->loadNemundoProcessContentDataContentContentcontentRow($model->content);
}
}
private function loadNemundoProcessContentDataContentContentsourceRow($model) {
$this->source = new \Nemundo\Process\Content\Row\ContentCustomRow($this->row, $model);
}
private function loadNemundoProcessGroupDataGroupGroupgroupRow($model) {
$this->group = new \Nemundo\Process\Group\Data\Group\GroupRow($this->row, $model);
}
private function loadNemundoProcessAppAssignmentDataAssignmentStatusAssignmentStatusstatusRow($model) {
$this->status = new \Nemundo\Process\App\Assignment\Data\AssignmentStatus\AssignmentStatusRow($this->row, $model);
}
private function loadNemundoProcessContentDataContentContentcontentRow($model) {
$this->content = new \Nemundo\Process\Content\Row\ContentCustomRow($this->row, $model);
}
}