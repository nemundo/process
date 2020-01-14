<?php
namespace Nemundo\Process\Template\Data\TemplateText;
class TemplateTextValue extends \Nemundo\Model\Value\AbstractModelDataValue {
/**
* @var TemplateTextModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new TemplateTextModel();
}
}