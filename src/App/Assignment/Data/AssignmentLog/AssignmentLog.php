<?php
namespace Nemundo\Process\App\Assignment\Data\AssignmentLog;
class AssignmentLog extends \Nemundo\Model\Data\AbstractModelData {
/**
* @var AssignmentLogModel
*/
protected $model;

/**
* @var string
*/
public $assignmentId;

public function __construct() {
parent::__construct();
$this->model = new AssignmentLogModel();
}
public function save() {
$this->typeValueList->setModelValue($this->model->assignmentId, $this->assignmentId);
$id = parent::save();
return $id;
}
}