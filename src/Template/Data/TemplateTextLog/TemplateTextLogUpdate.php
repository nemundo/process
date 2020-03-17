<?php
namespace Nemundo\Process\Template\Data\TemplateTextLog;
use Nemundo\Model\Data\AbstractModelUpdate;
class TemplateTextLogUpdate extends AbstractModelUpdate {
/**
* @var TemplateTextLogModel
*/
public $model;

/**
* @var string
*/
public $textFrom;

/**
* @var string
*/
public $textTo;

public function __construct() {
parent::__construct();
$this->model = new TemplateTextLogModel();
}
public function update() {
$this->typeValueList->setModelValue($this->model->textFrom, $this->textFrom);
$this->typeValueList->setModelValue($this->model->textTo, $this->textTo);
parent::update();
}
}