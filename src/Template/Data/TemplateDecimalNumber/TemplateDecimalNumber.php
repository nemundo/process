<?php
namespace Nemundo\Process\Template\Data\TemplateDecimalNumber;
class TemplateDecimalNumber extends \Nemundo\Model\Data\AbstractModelData {
/**
* @var TemplateDecimalNumberModel
*/
protected $model;

/**
* @var float
*/
public $decimalNumber;

public function __construct() {
parent::__construct();
$this->model = new TemplateDecimalNumberModel();
}
public function save() {
$value = (new \Nemundo\Core\Type\Text\Text($this->decimalNumber))->replace(",", ".")->getValue();
$this->typeValueList->setModelValue($this->model->decimalNumber, $value);
$id = parent::save();
return $id;
}
}