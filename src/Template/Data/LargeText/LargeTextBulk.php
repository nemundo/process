<?php
namespace Nemundo\Process\Template\Data\LargeText;
class LargeTextBulk extends \Nemundo\Model\Data\AbstractModelDataBulk {
/**
* @var LargeTextModel
*/
protected $model;

/**
* @var string
*/
public $id;

/**
* @var string
*/
public $largeText;

public function __construct() {
parent::__construct();
$this->model = new LargeTextModel();
}
public function save() {
$id = $this->id;
$this->typeValueList->setModelValue($this->model->id, $id);
$this->typeValueList->setModelValue($this->model->largeText, $this->largeText);
$id = parent::save();
return $id;
}
}