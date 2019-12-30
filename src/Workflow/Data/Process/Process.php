<?php
namespace Nemundo\Process\Workflow\Data\Process;
class Process extends \Nemundo\Model\Data\AbstractModelData {
/**
* @var ProcessModel
*/
protected $model;

/**
* @var string
*/
public $contentTypeId;

public function __construct() {
parent::__construct();
$this->model = new ProcessModel();
}
public function save() {
$this->typeValueList->setModelValue($this->model->contentTypeId, $this->contentTypeId);
$id = parent::save();
return $id;
}
}