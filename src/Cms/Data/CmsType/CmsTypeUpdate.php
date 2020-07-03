<?php
namespace Nemundo\Process\Cms\Data\CmsType;
use Nemundo\Model\Data\AbstractModelUpdate;
class CmsTypeUpdate extends AbstractModelUpdate {
/**
* @var CmsTypeModel
*/
public $model;

/**
* @var string
*/
public $parentContentTypeId;

/**
* @var string
*/
public $cmsContentTypeId;

/**
* @var bool
*/
public $setupStatus;

public function __construct() {
parent::__construct();
$this->model = new CmsTypeModel();
}
public function update() {
$this->typeValueList->setModelValue($this->model->parentContentTypeId, $this->parentContentTypeId);
$this->typeValueList->setModelValue($this->model->cmsContentTypeId, $this->cmsContentTypeId);
$this->typeValueList->setModelValue($this->model->setupStatus, $this->setupStatus);
parent::update();
}
}