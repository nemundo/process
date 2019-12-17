<?php
namespace Nemundo\Process\Content\Data\ContentType;
use Nemundo\Model\Data\AbstractModelUpdate;
class ContentTypeUpdate extends AbstractModelUpdate {
/**
* @var ContentTypeModel
*/
public $model;

/**
* @var string
*/
public $phpClass;

public function __construct() {
parent::__construct();
$this->model = new ContentTypeModel();
}
public function update() {
$this->typeValueList->setModelValue($this->model->phpClass, $this->phpClass);
parent::update();
}
}