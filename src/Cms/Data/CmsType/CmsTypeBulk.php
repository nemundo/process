<?php
namespace Nemundo\Process\Cms\Data\CmsType;
class CmsTypeBulk extends \Nemundo\Model\Data\AbstractModelDataBulk {
/**
* @var CmsTypeModel
*/
protected $model;

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
public function save() {
$this->typeValueList->setModelValue($this->model->parentContentTypeId, $this->parentContentTypeId);
$this->typeValueList->setModelValue($this->model->cmsContentTypeId, $this->cmsContentTypeId);
$this->typeValueList->setModelValue($this->model->setupStatus, $this->setupStatus);
$id = parent::save();
return $id;
}
}