<?php
namespace Nemundo\Process\Group\Data\GroupType;
class GroupTypeBulk extends \Nemundo\Model\Data\AbstractModelDataBulk {
/**
* @var GroupTypeModel
*/
protected $model;

/**
* @var string
*/
public $groupTypeId;

/**
* @var bool
*/
public $setupStatus;

public function __construct() {
parent::__construct();
$this->model = new GroupTypeModel();
}
public function save() {
$this->typeValueList->setModelValue($this->model->groupTypeId, $this->groupTypeId);
$this->typeValueList->setModelValue($this->model->setupStatus, $this->setupStatus);
$id = parent::save();
return $id;
}
}