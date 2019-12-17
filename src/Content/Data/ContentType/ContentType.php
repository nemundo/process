<?php
namespace Nemundo\Process\Content\Data\ContentType;
class ContentType extends \Nemundo\Model\Data\AbstractModelData {
/**
* @var ContentTypeModel
*/
protected $model;

/**
* @var string
*/
public $id;

/**
* @var string
*/
public $phpClass;

public function __construct() {
parent::__construct();
$this->model = new ContentTypeModel();
}
public function save() {
$id = $this->id;
$this->typeValueList->setModelValue($this->model->id, $id);
$this->typeValueList->setModelValue($this->model->phpClass, $this->phpClass);
$id = parent::save();
return $id;
}
}