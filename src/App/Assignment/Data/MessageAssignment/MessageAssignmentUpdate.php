<?php
namespace Nemundo\Process\App\Assignment\Data\MessageAssignment;
use Nemundo\Model\Data\AbstractModelUpdate;
class MessageAssignmentUpdate extends AbstractModelUpdate {
/**
* @var MessageAssignmentModel
*/
public $model;

/**
* @var string
*/
public $message;

public function __construct() {
parent::__construct();
$this->model = new MessageAssignmentModel();
}
public function update() {
$this->typeValueList->setModelValue($this->model->message, $this->message);
parent::update();
}
}