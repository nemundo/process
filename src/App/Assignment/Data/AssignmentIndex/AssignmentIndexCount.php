<?php
namespace Nemundo\Process\App\Assignment\Data\AssignmentIndex;
class AssignmentIndexCount extends \Nemundo\Model\Count\AbstractModelDataCount {
/**
* @var AssignmentIndexModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new AssignmentIndexModel();
}
}