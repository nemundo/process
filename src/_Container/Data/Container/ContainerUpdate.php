<?php
namespace Nemundo\Process\Container\Data\Container;
use Nemundo\Model\Data\AbstractModelUpdate;
class ContainerUpdate extends AbstractModelUpdate {
/**
* @var ContainerModel
*/
public $model;

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
public function update() {
$this->typeValueList->setModelValue($this->model->parentId, $this->parentId);
$this->typeValueList->setModelValue($this->model->contentId, $this->contentId);
$this->typeValueList->setModelValue($this->model->itemOrder, $this->itemOrder);
parent::update();
}
}