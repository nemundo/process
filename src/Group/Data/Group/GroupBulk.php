<?php
namespace Nemundo\Process\Group\Data\Group;
class GroupBulk extends \Nemundo\Model\Data\AbstractModelDataBulk {
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

public function __construct() {
parent::__construct();
$this->model = new GroupModel();
}
public function save() {
$id = $this->id;
$this->typeValueList->setModelValue($this->model->id, $id);
$this->typeValueList->setModelValue($this->model->group, $this->group);
$id = parent::save();
return $id;
}
}