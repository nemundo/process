<?php
namespace Nemundo\Process\Template\Data\SourceLog;
class SourceLogBulk extends \Nemundo\Model\Data\AbstractModelDataBulk {
/**
* @var SourceLogModel
*/
protected $model;

/**
* @var string
*/
public $sourceId;

public function __construct() {
parent::__construct();
$this->model = new SourceLogModel();
}
public function save() {
$this->typeValueList->setModelValue($this->model->sourceId, $this->sourceId);
$id = parent::save();
return $id;
}
}