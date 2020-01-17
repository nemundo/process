<?php
namespace Nemundo\Process\App\Assignment\Data\MessageAssignment;
class MessageAssignmentValue extends \Nemundo\Model\Value\AbstractModelDataValue {
/**
* @var MessageAssignmentModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new MessageAssignmentModel();
}
}