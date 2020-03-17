<?php
namespace Nemundo\Process\Template\Data\TemplateTextLog;
class TemplateTextLogValue extends \Nemundo\Model\Value\AbstractModelDataValue {
/**
* @var TemplateTextLogModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new TemplateTextLogModel();
}
}