<?php
namespace Nemundo\Process\Template\Data\TemplateImageIndex;
class TemplateImageIndexBulk extends \Nemundo\Model\Data\AbstractModelDataBulk {
/**
* @var TemplateImageIndexModel
*/
protected $model;

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
public function save() {
$this->typeValueList->setModelValue($this->model->parentId, $this->parentId);
$this->typeValueList->setModelValue($this->model->contentId, $this->contentId);
$this->typeValueList->setModelValue($this->model->urlSmall, $this->urlSmall);
$this->typeValueList->setModelValue($this->model->urlLarge, $this->urlLarge);
$this->typeValueList->setModelValue($this->model->itemOrder, $this->itemOrder);
$id = parent::save();
return $id;
}
}