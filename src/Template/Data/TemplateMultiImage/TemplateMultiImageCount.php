<?php
namespace Nemundo\Process\Template\Data\TemplateMultiImage;
class TemplateMultiImageCount extends \Nemundo\Model\Count\AbstractModelDataCount {
/**
* @var TemplateMultiImageModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new TemplateMultiImageModel();
}
}