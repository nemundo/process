<?php
namespace Nemundo\Process\Data\Status;
use Nemundo\Model\Data\AbstractModelUpdate;
class StatusUpdate extends AbstractModelUpdate {
/**
* @var StatusModel
*/
public $model;

/**
* @var string
*/
public $statusLabel;

/**
* @var string
*/
public $contentTypeId;

public function __construct() {
parent::__construct();
$this->model = new StatusModel();
}
public function update() {
$this->typeValueList->setModelValue($this->model->statusLabel, $this->statusLabel);
$this->typeValueList->setModelValue($this->model->contentTypeId, $this->contentTypeId);
parent::update();
}
}