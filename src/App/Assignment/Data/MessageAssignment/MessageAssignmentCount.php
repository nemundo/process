<?php
namespace Nemundo\Process\App\Assignment\Data\MessageAssignment;
class MessageAssignmentCount extends \Nemundo\Model\Count\AbstractModelDataCount {
/**
* @var MessageAssignmentModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new MessageAssignmentModel();
}
}