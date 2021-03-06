<?php
namespace Nemundo\Process\App\Assignment\Data\AssignmentLog;
class AssignmentLogRow extends \Nemundo\Model\Row\AbstractModelDataRow {
/**
* @var \Nemundo\Model\Row\AbstractModelDataRow
*/
private $row;

/**
* @var AssignmentLogModel
*/
public $model;

/**
* @var string
*/
public $id;

/**
* @var int
*/
public $assignmentId;

/**
* @var \Nemundo\Process\Group\Data\Group\GroupRow
*/
public $assignment;

public function __construct(\Nemundo\Db\Row\AbstractDataRow $row, $model) {
parent::__construct($row->getData());
$this->row = $row;
$this->id = $this->getModelValue($model->id);
$this->assignmentId = intval($this->getModelValue($model->assignmentId));
if ($model->assignment !== null) {
$this->loadNemundoProcessGroupDataGroupGroupassignmentRow($model->assignment);
}
}
private function loadNemundoProcessGroupDataGroupGroupassignmentRow($model) {
$this->assignment = new \Nemundo\Process\Group\Data\Group\GroupRow($this->row, $model);
}
}