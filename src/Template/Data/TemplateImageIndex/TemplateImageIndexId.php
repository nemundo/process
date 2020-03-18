<?php
namespace Nemundo\Process\Template\Data\TemplateImageIndex;
use Nemundo\Model\Id\AbstractModelIdValue;
class TemplateImageIndexId extends AbstractModelIdValue {
/**
* @var TemplateImageIndexModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new TemplateImageIndexModel();
}
}