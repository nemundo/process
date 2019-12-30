<?php
namespace Nemundo\Process\Workflow\Data\Process;
use Nemundo\Model\Data\AbstractModelUpdate;
class ProcessUpdate extends AbstractModelUpdate {
/**
* @var ProcessModel
*/
public $model;

/**
* @var string
*/
public $contentTypeId;

public function __construct() {
parent::__construct();
$this->model = new ProcessModel();
}
public function update() {
$this->typeValueList->setModelValue($this->model->contentTypeId, $this->contentTypeId);
parent::update();
}
}