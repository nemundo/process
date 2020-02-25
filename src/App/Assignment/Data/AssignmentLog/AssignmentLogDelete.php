<?php
namespace Nemundo\Process\App\Assignment\Data\AssignmentLog;
class AssignmentLogDelete extends \Nemundo\Model\Delete\AbstractModelDelete {
/**
* @var AssignmentLogModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new AssignmentLogModel();
}
}