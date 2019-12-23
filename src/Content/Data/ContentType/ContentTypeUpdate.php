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

/**
* @var string
*/
public $contentType;

public function __construct() {
parent::__construct();
$this->model = new ContentTypeModel();
}
public function update() {
$this->typeValueList->setModelValue($this->model->phpClass, $this->phpClass);
$this->typeValueList->setModelValue($this->model->contentType, $this->contentType);
parent::update();
}
}