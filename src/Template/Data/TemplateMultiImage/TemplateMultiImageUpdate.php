<?php
namespace Nemundo\Process\Template\Data\TemplateMultiImage;
use Nemundo\Model\Data\AbstractModelUpdate;
class TemplateMultiImageUpdate extends AbstractModelUpdate {
/**
* @var TemplateMultiImageModel
*/
public $model;

/**
* @var bool
*/
public $active;

/**
* @var \Nemundo\Model\Data\Property\File\ImageDataProperty
*/
public $image;

/**
* @var string
*/
public $dataContentId;

public function __construct() {
parent::__construct();
$this->model = new TemplateMultiImageModel();
$this->image = new \Nemundo\Model\Data\Property\File\ImageDataProperty($this->model->image, $this->typeValueList);
}
public function update() {
$this->typeValueList->setModelValue($this->model->active, $this->active);
$this->typeValueList->setModelValue($this->model->dataContentId, $this->dataContentId);
parent::update();
}
}