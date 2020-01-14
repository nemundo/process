<?php
namespace Nemundo\Process\Template\Data\TemplateText;
class TemplateTextDelete extends \Nemundo\Model\Delete\AbstractModelDelete {
/**
* @var TemplateTextModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new TemplateTextModel();
}
}