<?php
namespace Nemundo\Process\Template\Data\TemplateDate;
class TemplateDateValue extends \Nemundo\Model\Value\AbstractModelDataValue {
/**
* @var TemplateDateModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new TemplateDateModel();
}
}