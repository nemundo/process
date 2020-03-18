<?php
namespace Nemundo\Process\Template\Data\TemplateImageIndex;
class TemplateImageIndexDelete extends \Nemundo\Model\Delete\AbstractModelDelete {
/**
* @var TemplateImageIndexModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new TemplateImageIndexModel();
}
}