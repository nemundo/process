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
* @var string
*/
public $assignmentId;

/**
* @var \Nemundo\Process\Group\Row\GroupCustomRow
*/
public $assignment;

public function __construct(\Nemundo\Db\Row\AbstractDataRow $row, $model) {
parent::__construct($row->getData());
$this->row = $row;
$this->id = $this->getModelValue($model->id);
$this->assignmentId = $this->getModelValue($model->assignmentId);
if ($model->assignment !== null) {
$this->loadNemundoProcessGroupDataGroupGroupassignmentRow($model->assignment);
}
}
private function loadNemundoProcessGroupDataGroupGroupassignmentRow($model) {
$this->assignment = new \Nemundo\Process\Group\Row\GroupCustomRow($this->row, $model);
}
}