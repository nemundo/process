<?php
namespace Nemundo\Process\Template\Data\TemplateText;
class TemplateText extends \Nemundo\Model\Data\AbstractModelData {
/**
* @var TemplateTextModel
*/
protected $model;

/**
* @var string
*/
public $text;

public function __construct() {
parent::__construct();
$this->model = new TemplateTextModel();
}
public function save() {
$this->typeValueList->setModelValue($this->model->text, $this->text);
$id = parent::save();
return $id;
}
}