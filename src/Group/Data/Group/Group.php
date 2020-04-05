<?php
namespace Nemundo\Process\Group\Data\Group;
class Group extends \Nemundo\Model\Data\AbstractModelData {
/**
* @var GroupModel
*/
protected $model;

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

/**
* @var string
*/
public $contentId;

public function __construct() {
parent::__construct();
$this->model = new GroupModel();
}
public function save() {
$this->typeValueList->setModelValue($this->model->active, $this->active);
$this->typeValueList->setModelValue($this->model->group, $this->group);
$this->typeValueList->setModelValue($this->model->groupTypeId, $this->groupTypeId);
$this->typeValueList->setModelValue($this->model->contentId, $this->contentId);
$id = parent::save();
return $id;
}
}