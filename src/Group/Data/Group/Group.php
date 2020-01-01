<?php
namespace Nemundo\Process\Group\Data\Group;
class Group extends \Nemundo\Model\Data\AbstractModelData {
/**
* @var GroupModel
*/
protected $model;

/**
* @var string
*/
public $id;

/**
* @var string
*/
public $group;

/**
* @var string
*/
public $groupTypeId;

public function __construct() {
parent::__construct();
$this->model = new GroupModel();
}
public function save() {
$id = $this->id;
$this->typeValueList->setModelValue($this->model->id, $id);
$this->typeValueList->setModelValue($this->model->group, $this->group);
$this->typeValueList->setModelValue($this->model->groupTypeId, $this->groupTypeId);
$id = parent::save();
return $id;
}
}