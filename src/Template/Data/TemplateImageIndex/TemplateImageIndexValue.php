<?php
namespace Nemundo\Process\Template\Data\TemplateImageIndex;
class TemplateImageIndexValue extends \Nemundo\Model\Value\AbstractModelDataValue {
/**
* @var TemplateImageIndexModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new TemplateImageIndexModel();
}
}