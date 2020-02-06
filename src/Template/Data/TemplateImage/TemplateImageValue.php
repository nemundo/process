<?php
namespace Nemundo\Process\Template\Data\TemplateImage;
class TemplateImageValue extends \Nemundo\Model\Value\AbstractModelDataValue {
/**
* @var TemplateImageModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new TemplateImageModel();
}
}