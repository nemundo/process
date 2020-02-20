<?php
namespace Nemundo\Process\Group\Data\Group;
use Nemundo\Model\Data\AbstractModelUpdate;
class GroupUpdate extends AbstractModelUpdate {
/**
* @var GroupModel
*/
public $model;

/**
* @var bool
*/
public $active;

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
public function update() {
$this->typeValueList->setModelValue($this->model->active, $this->active);
$this->typeValueList->setModelValue($this->model->group, $this->group);
$this->typeValueList->setModelValue($this->model->groupTypeId, $this->groupTypeId);
parent::update();
}
}