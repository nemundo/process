<?php
namespace Nemundo\Process\App\Assignment\Data\AssignmentSource;
class AssignmentSourceCount extends \Nemundo\Model\Count\AbstractModelDataCount {
/**
* @var AssignmentSourceModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new AssignmentSourceModel();
}
}