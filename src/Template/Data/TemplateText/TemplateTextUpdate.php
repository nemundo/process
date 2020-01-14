<?php
namespace Nemundo\Process\Template\Data\TemplateText;
use Nemundo\Model\Data\AbstractModelUpdate;
class TemplateTextUpdate extends AbstractModelUpdate {
/**
* @var TemplateTextModel
*/
public $model;

/**
* @var string
*/
public $text;

public function __construct() {
parent::__construct();
$this->model = new TemplateTextModel();
}
public function update() {
$this->typeValueList->setModelValue($this->model->text, $this->text);
parent::update();
}
}