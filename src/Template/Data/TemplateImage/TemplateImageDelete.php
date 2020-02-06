<?php
namespace Nemundo\Process\Template\Data\TemplateImage;
class TemplateImageDelete extends \Nemundo\Model\Delete\AbstractModelDelete {
/**
* @var TemplateImageModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new TemplateImageModel();
}
}