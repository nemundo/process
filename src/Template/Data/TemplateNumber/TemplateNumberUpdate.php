<?php
namespace Nemundo\Process\Template\Data\TemplateNumber;
use Nemundo\Model\Data\AbstractModelUpdate;
class TemplateNumberUpdate extends AbstractModelUpdate {
/**
* @var TemplateNumberModel
*/
public $model;

/**
* @var int
*/
public $number;

public function __construct() {
parent::__construct();
$this->model = new TemplateNumberModel();
}
public function update() {
$this->typeValueList->setModelValue($this->model->number, $this->number);
parent::update();
}
}