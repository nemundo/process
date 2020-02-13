<?php
namespace Nemundo\Process\Template\Data\TemplateNumber;
class TemplateNumberBulk extends \Nemundo\Model\Data\AbstractModelDataBulk {
/**
* @var TemplateNumberModel
*/
protected $model;

/**
* @var int
*/
public $number;

public function __construct() {
parent::__construct();
$this->model = new TemplateNumberModel();
}
public function save() {
$this->typeValueList->setModelValue($this->model->number, $this->number);
$id = parent::save();
return $id;
}
}