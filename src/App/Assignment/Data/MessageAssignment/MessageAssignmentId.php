<?php
namespace Nemundo\Process\App\Assignment\Data\MessageAssignment;
use Nemundo\Model\Id\AbstractModelIdValue;
class MessageAssignmentId extends AbstractModelIdValue {
/**
* @var MessageAssignmentModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new MessageAssignmentModel();
}
}