<?php
namespace Nemundo\Process\Template\Data\GroupAssignment;
class GroupAssignmentRow extends \Nemundo\Model\Row\AbstractModelDataRow {
/**
* @var \Nemundo\Model\Row\AbstractModelDataRow
*/
private $row;

/**
* @var GroupAssignmentModel
*/
public $model;

/**
* @var string
*/
public $id;

/**
* @var string
*/
public $groupId;

/**
* @var \Nemundo\Process\Group\Data\Group\GroupRow
*/
public $group;

/**
* @var \Nemundo\Core\Type\DateTime\Date
*/
public $deadline;

public function __construct(\Nemundo\Db\Row\AbstractDataRow $row, $model) {
parent::__construct($row->getData());
$this->row = $row;
$this->id = $this->getModelValue($model->id);
$this->groupId = $this->getModelValue($model->groupId);
if ($model->group !== null) {
$this->loadNemundoProcessGroupDataGroupGroupgroupRow($model->group);
}
$value = $this->getModelValue($model->deadline);
if ($value !== "0000-00-00") {
$this->deadline = new \Nemundo\Core\Type\DateTime\Date($this->getModelValue($model->deadline));
}
}
private function loadNemundoProcessGroupDataGroupGroupgroupRow($model) {
$this->group = new \Nemundo\Process\Group\Data\Group\GroupRow($this->row, $model);
}
}