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
$value = (new \Nemundo\Core\Type\Text\Text($this->decimalNumber))->replace(",", ".")->getValue();
$this->typeValueList->setModelValue($this->model->decimalNumber, $value);
parent::update();
}
}