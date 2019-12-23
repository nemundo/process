<?php
namespace Nemundo\Process\Content\Data\Tree;
class Tree extends \Nemundo\Model\Data\AbstractModelData {
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

/**
* @var int
*/
public $itemOrder;

public function __construct() {
parent::__construct();
$this->model = new TreeModel();
}
public function save() {
$this->typeValueList->setModelValue($this->model->childId, $this->childId);
$this->typeValueList->setModelValue($this->model->parentId, $this->parentId);
$this->typeValueList->setModelValue($this->model->itemOrder, $this->itemOrder);
$id = parent::save();
return $id;
}
}