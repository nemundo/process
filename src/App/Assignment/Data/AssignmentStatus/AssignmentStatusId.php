<?php
namespace Nemundo\Process\App\Assignment\Data\AssignmentStatus;
use Nemundo\Model\Id\AbstractModelIdValue;
class AssignmentStatusId extends AbstractModelIdValue {
/**
* @var AssignmentStatusModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new AssignmentStatusModel();
}
}