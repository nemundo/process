<?php
namespace Nemundo\Process\Template\Data\TemplateDecimalNumber;
use Nemundo\Model\Data\AbstractModelUpdate;
class TemplateDecimalNumberUpdate extends AbstractModelUpdate {
/**
* @var TemplateDecimalNumberModel
*/
public $model;

/**
* @var float
*/
public $decimalNumber;

public function __construct() {
parent::__construct();
$this->model = new TemplateDecimalNumberModel();
}
public function update() {
if (!is_null($this->decimalNumber)) $this->decimalNumber = str_replace(",", ".", $this->decimalNumber);
$this->typeValueList->setModelValue($this->model->decimalNumber, $this->decimalNumber);
parent::update();
}
}