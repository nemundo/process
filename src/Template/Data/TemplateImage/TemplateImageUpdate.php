<?php
namespace Nemundo\Process\Template\Data\TemplateImage;
use Nemundo\Model\Data\AbstractModelUpdate;
class TemplateImageUpdate extends AbstractModelUpdate {
/**
* @var TemplateImageModel
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

public function __construct() {
parent::__construct();
$this->model = new TemplateImageModel();
$this->image = new \Nemundo\Model\Data\Property\File\ImageDataProperty($this->model->image, $this->typeValueList);
}
public function update() {
$this->typeValueList->setModelValue($this->model->active, $this->active);
parent::update();
}
}