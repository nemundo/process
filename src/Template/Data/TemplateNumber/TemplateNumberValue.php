<?php
namespace Nemundo\Process\Template\Data\TemplateNumber;
class TemplateNumberValue extends \Nemundo\Model\Value\AbstractModelDataValue {
/**
* @var TemplateNumberModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new TemplateNumberModel();
}
}