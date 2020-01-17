<?php
namespace Nemundo\Process\App\Assignment\Data\MessageAssignment;
class MessageAssignment extends \Nemundo\Model\Data\AbstractModelData {
/**
* @var MessageAssignmentModel
*/
protected $model;

/**
* @var string
*/
public $message;

public function __construct() {
parent::__construct();
$this->model = new MessageAssignmentModel();
}
public function save() {
$this->typeValueList->setModelValue($this->model->message, $this->message);
$id = parent::save();
return $id;
}
}