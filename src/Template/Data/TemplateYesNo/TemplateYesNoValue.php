<?php
namespace Nemundo\Process\Template\Data\TemplateYesNo;
class TemplateYesNoValue extends \Nemundo\Model\Value\AbstractModelDataValue {
/**
* @var TemplateYesNoModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new TemplateYesNoModel();
}
}