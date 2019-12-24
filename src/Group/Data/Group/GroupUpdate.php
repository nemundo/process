<?php
namespace Nemundo\Process\Group\Data\Group;
use Nemundo\Model\Data\AbstractModelUpdate;
class GroupUpdate extends AbstractModelUpdate {
/**
* @var GroupModel
*/
public $model;

/**
* @var string
*/
public $group;

public function __construct() {
parent::__construct();
$this->model = new GroupModel();
}
public function update() {
$this->typeValueList->setModelValue($this->model->group, $this->group);
parent::update();
}
}