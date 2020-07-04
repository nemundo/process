<?php
namespace Nemundo\Process\Container\Data\Container;
class Container extends \Nemundo\Model\Data\AbstractModelData {
/**
* @var ContainerModel
*/
protected $model;

/**
* @var string
*/
public $parentId;

/**
* @var string
*/
public $contentId;

/**
* @var int
*/
public $itemOrder;

public function __construct() {
parent::__construct();
$this->model = new ContainerModel();
}
public function save() {
$this->typeValueList->setModelValue($this->model->parentId, $this->parentId);
$this->typeValueList->setModelValue($this->model->contentId, $this->contentId);
$this->typeValueList->setModelValue($this->model->itemOrder, $this->itemOrder);
$id = parent::save();
return $id;
}
}