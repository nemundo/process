<?php
namespace Nemundo\Process\App\Assignment\Data\AssignmentSource;
class AssignmentSourceBulk extends \Nemundo\Model\Data\AbstractModelDataBulk {
/**
* @var AssignmentSourceModel
*/
protected $model;

/**
* @var string
*/
public $sourceId;

public function __construct() {
parent::__construct();
$this->model = new AssignmentSourceModel();
}
public function save() {
$this->typeValueList->setModelValue($this->model->sourceId, $this->sourceId);
$id = parent::save();
return $id;
}
}