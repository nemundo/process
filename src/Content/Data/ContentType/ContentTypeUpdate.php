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
public function update() {
$this->typeValueList->setModelValue($this->model->phpClass, $this->phpClass);
$this->typeValueList->setModelValue($this->model->contentType, $this->contentType);
$this->typeValueList->setModelValue($this->model->setupStatus, $this->setupStatus);
$this->typeValueList->setModelValue($this->model->applicationId, $this->applicationId);
parent::update();
}
}