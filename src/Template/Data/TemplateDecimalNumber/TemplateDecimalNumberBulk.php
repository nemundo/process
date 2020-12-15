<?php
namespace Nemundo\Process\Template\Data\TemplateDecimalNumber;
class TemplateDecimalNumberBulk extends \Nemundo\Model\Data\AbstractModelDataBulk {
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
if (!is_null($this->decimalNumber)) $this->decimalNumber = str_replace(",", ".", $this->decimalNumber);
$this->typeValueList->setModelValue($this->model->decimalNumber, $this->decimalNumber);
$id = parent::save();
return $id;
}
}