<?php
namespace Nemundo\Process\Relation\Data\Relation;
use Nemundo\Model\Data\AbstractModelUpdate;
class RelationUpdate extends AbstractModelUpdate {
/**
* @var RelationModel
*/
public $model;

/**
* @var string
*/
public $fromId;

/**
* @var string
*/
public $toId;

public function __construct() {
parent::__construct();
$this->model = new RelationModel();
}
public function update() {
$this->typeValueList->setModelValue($this->model->fromId, $this->fromId);
$this->typeValueList->setModelValue($this->model->toId, $this->toId);
parent::update();
}
}