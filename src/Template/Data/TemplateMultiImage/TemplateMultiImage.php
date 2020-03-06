<?php
namespace Nemundo\Process\Template\Data\TemplateMultiImage;
class TemplateMultiImage extends \Nemundo\Model\Data\AbstractModelData {
/**
* @var TemplateMultiImageModel
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

/**
* @var string
*/
public $dataContentId;

public function __construct() {
parent::__construct();
$this->model = new TemplateMultiImageModel();
$this->image = new \Nemundo\Model\Data\Property\File\ImageDataProperty($this->model->image, $this->typeValueList);
}
public function save() {
$this->typeValueList->setModelValue($this->model->active, $this->active);
$this->typeValueList->setModelValue($this->model->dataContentId, $this->dataContentId);
$id = parent::save();
return $id;
}
}