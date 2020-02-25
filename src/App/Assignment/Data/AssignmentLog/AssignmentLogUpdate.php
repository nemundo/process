<?php
namespace Nemundo\Process\App\Assignment\Data\AssignmentLog;
use Nemundo\Model\Data\AbstractModelUpdate;
class AssignmentLogUpdate extends AbstractModelUpdate {
/**
* @var AssignmentLogModel
*/
public $model;

/**
* @var string
*/
public $assignmentId;

public function __construct() {
parent::__construct();
$this->model = new AssignmentLogModel();
}
public function update() {
$this->typeValueList->setModelValue($this->model->assignmentId, $this->assignmentId);
parent::update();
}
}