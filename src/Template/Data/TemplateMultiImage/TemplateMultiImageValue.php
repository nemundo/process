<?php
namespace Nemundo\Process\Template\Data\TemplateMultiImage;
class TemplateMultiImageValue extends \Nemundo\Model\Value\AbstractModelDataValue {
/**
* @var TemplateMultiImageModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new TemplateMultiImageModel();
}
}