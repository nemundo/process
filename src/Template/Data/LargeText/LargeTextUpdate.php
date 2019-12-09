<?php
namespace Nemundo\Process\Template\Data\LargeText;
use Nemundo\Model\Data\AbstractModelUpdate;
class LargeTextUpdate extends AbstractModelUpdate {
/**
* @var LargeTextModel
*/
public $model;

/**
* @var string
*/
public $largeText;

public function __construct() {
parent::__construct();
$this->model = new LargeTextModel();
}
public function update() {
$this->typeValueList->setModelValue($this->model->largeText, $this->largeText);
parent::update();
}
}