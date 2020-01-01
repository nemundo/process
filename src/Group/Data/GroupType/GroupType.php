<?php
namespace Nemundo\Process\Group\Data\GroupType;
class GroupType extends \Nemundo\Model\Data\AbstractModelData {
/**
* @var GroupTypeModel
*/
protected $model;

/**
* @var string
*/
public $id;

/**
* @var string
*/
public $groupType;

public function __construct() {
parent::__construct();
$this->model = new GroupTypeModel();
}
public function save() {
$id = $this->id;
$this->typeValueList->setModelValue($this->model->id, $id);
$this->typeValueList->setModelValue($this->model->groupType, $this->groupType);
$id = parent::save();
return $id;
}
}