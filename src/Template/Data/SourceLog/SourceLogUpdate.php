<?php
namespace Nemundo\Process\Template\Data\SourceLog;
use Nemundo\Model\Data\AbstractModelUpdate;
class SourceLogUpdate extends AbstractModelUpdate {
/**
* @var SourceLogModel
*/
public $model;

/**
* @var string
*/
public $sourceId;

public function __construct() {
parent::__construct();
$this->model = new SourceLogModel();
}
public function update() {
$this->typeValueList->setModelValue($this->model->sourceId, $this->sourceId);
parent::update();
}
}