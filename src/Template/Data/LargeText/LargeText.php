<?php
namespace Nemundo\Process\Template\Data\LargeText;
class LargeText extends \Nemundo\Model\Data\AbstractModelData {
/**
* @var LargeTextModel
*/
protected $model;

/**
* @var string
*/
public $largeText;

public function __construct() {
parent::__construct();
$this->model = new LargeTextModel();
}
public function save() {
$this->typeValueList->setModelValue($this->model->largeText, $this->largeText);
$id = parent::save();
return $id;
}
}