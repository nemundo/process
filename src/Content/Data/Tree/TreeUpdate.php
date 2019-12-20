<?php
namespace Nemundo\Process\Content\Data\Tree;
use Nemundo\Model\Data\AbstractModelUpdate;
class TreeUpdate extends AbstractModelUpdate {
/**
* @var TreeModel
*/
public $model;

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
public function update() {
$this->typeValueList->setModelValue($this->model->childId, $this->childId);
$this->typeValueList->setModelValue($this->model->parentId, $this->parentId);
parent::update();
}
}