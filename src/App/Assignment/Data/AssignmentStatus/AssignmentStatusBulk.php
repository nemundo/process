<?php
namespace Nemundo\Process\App\Assignment\Data\AssignmentStatus;
class AssignmentStatusBulk extends \Nemundo\Model\Data\AbstractModelDataBulk {
/**
* @var AssignmentStatusModel
*/
protected $model;

/**
* @var int
*/
public $id;

/**
* @var string
*/
public $status;

public function __construct() {
parent::__construct();
$this->model = new AssignmentStatusModel();
}
public function save() {
$id = $this->id;
$this->typeValueList->setModelValue($this->model->id, $id);
$this->typeValueList->setModelValue($this->model->status, $this->status);
$id = parent::save();
return $id;
}
}