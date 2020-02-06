<?php
namespace Nemundo\Process\Template\Data\TemplateImage;
use Nemundo\Model\Id\AbstractModelIdValue;
class TemplateImageId extends AbstractModelIdValue {
/**
* @var TemplateImageModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new TemplateImageModel();
}
}