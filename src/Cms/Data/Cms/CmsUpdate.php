<?php
namespace Nemundo\Process\Cms\Data\Cms;
use Nemundo\Model\Data\AbstractModelUpdate;
class CmsUpdate extends AbstractModelUpdate {
/**
* @var CmsModel
*/
public $model;

/**
* @var string
*/
public $parentId;

/**
* @var string
*/
public $contentId;

/**
* @var int
*/
public $itemOrder;

public function __construct() {
parent::__construct();
$this->model = new CmsModel();
}
public function update() {
$this->typeValueList->setModelValue($this->model->parentId, $this->parentId);
$this->typeValueList->setModelValue($this->model->contentId, $this->contentId);
$this->typeValueList->setModelValue($this->model->itemOrder, $this->itemOrder);
parent::update();
}
}