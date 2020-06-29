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

/**
* @var string
*/
public $contentType;

/**
* @var bool
*/
public $setupStatus;

/**
* @var string
*/
public $applicationId;

public function __construct() {
parent::__construct();
$this->model = new ContentTypeModel();
}
public function save() {
$id = $this->id;
$this->typeValueList->setModelValue($this->model->id, $id);
$this->typeValueList->setModelValue($this->model->phpClass, $this->phpClass);
$this->typeValueList->setModelValue($this->model->contentType, $this->contentType);
$this->typeValueList->setModelValue($this->model->setupStatus, $this->setupStatus);
$this->typeValueList->setModelValue($this->model->applicationId, $this->applicationId);
$id = parent::save();
return $id;
}
}