<?php
namespace Nemundo\Process\Group\Data\Group;
class GroupRow extends \Nemundo\Model\Row\AbstractModelDataRow {
/**
* @var \Nemundo\Model\Row\AbstractModelDataRow
*/
private $row;

/**
* @var GroupModel
*/
public $model;

/**
* @var string
*/
public $id;

/**
* @var string
*/
public $group;

public function __construct(\Nemundo\Db\Row\AbstractDataRow $row, $model) {
parent::__construct($row->getData());
$this->row = $row;
$this->id = $this->getModelValue($model->id);
$this->group = $this->getModelValue($model->group);
}
}