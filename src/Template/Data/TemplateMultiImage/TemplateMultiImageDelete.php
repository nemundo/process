<?php
namespace Nemundo\Process\Template\Data\TemplateMultiImage;
class TemplateMultiImageDelete extends \Nemundo\Model\Delete\AbstractModelDelete {
/**
* @var TemplateMultiImageModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new TemplateMultiImageModel();
}
}