<?php
namespace Nemundo\Process\Relation\Data\Relation;
class Relation extends \Nemundo\Model\Data\AbstractModelData {
/**
* @var RelationModel
*/
protected $model;

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
public function save() {
$this->typeValueList->setModelValue($this->model->fromId, $this->fromId);
$this->typeValueList->setModelValue($this->model->toId, $this->toId);
$id = parent::save();
return $id;
}
}