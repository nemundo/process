<?php
namespace Nemundo\Process\App\Assignment\Data\AssignmentLog;
class AssignmentLogCount extends \Nemundo\Model\Count\AbstractModelDataCount {
/**
* @var AssignmentLogModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new AssignmentLogModel();
}
}