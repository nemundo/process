<?php
namespace Nemundo\Process\Template\Data\TemplateImageIndex;
use Nemundo\Model\Data\AbstractModelUpdate;
class TemplateImageIndexUpdate extends AbstractModelUpdate {
/**
* @var TemplateImageIndexModel
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
* @var string
*/
public $urlSmall;

/**
* @var string
*/
public $urlLarge;

/**
* @var int
*/
public $itemOrder;

public function __construct() {
parent::__construct();
$this->model = new TemplateImageIndexModel();
}
public function update() {
$this->typeValueList->setModelValue($this->model->parentId, $this->parentId);
$this->typeValueList->setModelValue($this->model->contentId, $this->contentId);
$this->typeValueList->setModelValue($this->model->urlSmall, $this->urlSmall);
$this->typeValueList->setModelValue($this->model->urlLarge, $this->urlLarge);
$this->typeValueList->setModelValue($this->model->itemOrder, $this->itemOrder);
parent::update();
}
}