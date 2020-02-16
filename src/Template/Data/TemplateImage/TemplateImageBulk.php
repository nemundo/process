<?php
namespace Nemundo\Process\Template\Data\TemplateImage;
class TemplateImageBulk extends \Nemundo\Model\Data\AbstractModelDataBulk {
/**
* @var TemplateImageModel
*/
protected $model;

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
$id = parent::save();
return $id;
}
}