<?php
namespace Nemundo\Process\Content\Data\ContentType;
class ContentTypeBulk extends \Nemundo\Model\Data\AbstractModelDataBulk {
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

/**
* @var string
*/
public $contentType;

public function __construct() {
parent::__construct();
$this->model = new ContentTypeModel();
}
public function save() {
$id = $this->id;
$this->typeValueList->setModelValue($this->model->id, $id);
$this->typeValueList->setModelValue($this->model->phpClass, $this->phpClass);
$this->typeValueList->setModelValue($this->model->contentType, $this->contentType);
$id = parent::save();
return $id;
}
}