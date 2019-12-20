<?php
namespace Nemundo\Process\Workflow\Data\Status;
class Status extends \Nemundo\Model\Data\AbstractModelData {
/**
* @var StatusModel
*/
protected $model;

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
public function save() {
$this->typeValueList->setModelValue($this->model->statusLabel, $this->statusLabel);
$this->typeValueList->setModelValue($this->model->contentTypeId, $this->contentTypeId);
$id = parent::save();
return $id;
}
}