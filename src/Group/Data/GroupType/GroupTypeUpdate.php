<?php
namespace Nemundo\Process\Group\Data\GroupType;
use Nemundo\Model\Data\AbstractModelUpdate;
class GroupTypeUpdate extends AbstractModelUpdate {
/**
* @var GroupTypeModel
*/
public $model;

/**
* @var string
*/
public $groupType;

public function __construct() {
parent::__construct();
$this->model = new GroupTypeModel();
}
public function update() {
$this->typeValueList->setModelValue($this->model->groupType, $this->groupType);
parent::update();
}
}