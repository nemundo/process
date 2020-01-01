<?php
namespace Nemundo\Process\Group\Data\GroupType;
class GroupTypeRow extends \Nemundo\Model\Row\AbstractModelDataRow {
/**
* @var \Nemundo\Model\Row\AbstractModelDataRow
*/
private $row;

/**
* @var GroupTypeModel
*/
public $model;

/**
* @var string
*/
public $id;

/**
* @var string
*/
public $groupType;

public function __construct(\Nemundo\Db\Row\AbstractDataRow $row, $model) {
parent::__construct($row->getData());
$this->row = $row;
$this->id = $this->getModelValue($model->id);
$this->groupType = $this->getModelValue($model->groupType);
}
}