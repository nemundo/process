<?php
namespace Nemundo\Process\Content\Data\Tree;
class TreeBulk extends \Nemundo\Model\Data\AbstractModelDataBulk {
/**
* @var TreeModel
*/
protected $model;

/**
* @var string
*/
public $childId;

/**
* @var string
*/
public $parentId;

public function __construct() {
parent::__construct();
$this->model = new TreeModel();
}
public function save() {
$this->typeValueList->setModelValue($this->model->childId, $this->childId);
$this->typeValueList->setModelValue($this->model->parentId, $this->parentId);
$id = parent::save();
return $id;
}
}