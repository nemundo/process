<?php
namespace Nemundo\Process\Template\Data\TemplateImageIndex;
class TemplateImageIndexCount extends \Nemundo\Model\Count\AbstractModelDataCount {
/**
* @var TemplateImageIndexModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new TemplateImageIndexModel();
}
}