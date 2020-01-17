<?php
namespace Nemundo\Process\App\Assignment\Data\AssignmentStatus;
class AssignmentStatusDelete extends \Nemundo\Model\Delete\AbstractModelDelete {
/**
* @var AssignmentStatusModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new AssignmentStatusModel();
}
}