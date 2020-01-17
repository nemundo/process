<?php
namespace Nemundo\Process\App\Assignment\Data\AssignmentStatus;
use Nemundo\Model\Data\AbstractModelUpdate;
class AssignmentStatusUpdate extends AbstractModelUpdate {
/**
* @var AssignmentStatusModel
*/
public $model;

/**
* @var string
*/
public $status;

public function __construct() {
parent::__construct();
$this->model = new AssignmentStatusModel();
}
public function update() {
$this->typeValueList->setModelValue($this->model->status, $this->status);
parent::update();
}
}