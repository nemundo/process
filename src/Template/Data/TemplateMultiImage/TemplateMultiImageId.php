<?php
namespace Nemundo\Process\Template\Data\TemplateMultiImage;
use Nemundo\Model\Id\AbstractModelIdValue;
class TemplateMultiImageId extends AbstractModelIdValue {
/**
* @var TemplateMultiImageModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new TemplateMultiImageModel();
}
}