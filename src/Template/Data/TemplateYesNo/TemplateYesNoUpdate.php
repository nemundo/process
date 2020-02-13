<?php
namespace Nemundo\Process\Template\Data\TemplateYesNo;
use Nemundo\Model\Data\AbstractModelUpdate;
class TemplateYesNoUpdate extends AbstractModelUpdate {
/**
* @var TemplateYesNoModel
*/
public $model;

/**
* @var bool
*/
public $yesNo;

public function __construct() {
parent::__construct();
$this->model = new TemplateYesNoModel();
}
public function update() {
$this->typeValueList->setModelValue($this->model->yesNo, $this->yesNo);
parent::update();
}
}