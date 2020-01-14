<?php
namespace Nemundo\Process\Template\Data\TemplateText;
class TemplateTextBulk extends \Nemundo\Model\Data\AbstractModelDataBulk {
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