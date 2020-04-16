<?php
namespace Nemundo\Process\Template\Data\TemplateImage;
class TemplateImage extends \Nemundo\Model\Data\AbstractModelData {
/**
* @var TemplateImageModel
*/
protected $model;

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
public function save() {
$this->typeValueList->setModelValue($this->model->active, $this->active);
$id = parent::save();
return $id;
}
}