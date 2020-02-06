<?php
namespace Nemundo\Process\Template\Data\TemplateImage;
class TemplateImageCount extends \Nemundo\Model\Count\AbstractModelDataCount {
/**
* @var TemplateImageModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new TemplateImageModel();
}
}