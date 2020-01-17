<?php
namespace Nemundo\Process\App\Assignment\Data\AssignmentStatus;
class AssignmentStatusCount extends \Nemundo\Model\Count\AbstractModelDataCount {
/**
* @var AssignmentStatusModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new AssignmentStatusModel();
}
}