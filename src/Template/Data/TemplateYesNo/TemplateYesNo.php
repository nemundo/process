<?php
namespace Nemundo\Process\Template\Data\TemplateYesNo;
class TemplateYesNo extends \Nemundo\Model\Data\AbstractModelData {
/**
* @var TemplateYesNoModel
*/
protected $model;

/**
* @var bool
*/
public $yesNo;

public function __construct() {
parent::__construct();
$this->model = new TemplateYesNoModel();
}
public function save() {
$this->typeValueList->setModelValue($this->model->yesNo, $this->yesNo);
$id = parent::save();
return $id;
}
}