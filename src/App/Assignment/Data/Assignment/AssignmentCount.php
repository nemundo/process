<?php
namespace Nemundo\Process\App\Assignment\Data\Assignment;
class AssignmentCount extends \Nemundo\Model\Count\AbstractModelDataCount {
/**
* @var AssignmentModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new AssignmentModel();
}
}