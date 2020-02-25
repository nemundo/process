<?php
namespace Nemundo\Process\App\Assignment\Data\AssignmentIndex;
class AssignmentIndexValue extends \Nemundo\Model\Value\AbstractModelDataValue {
/**
* @var AssignmentIndexModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new AssignmentIndexModel();
}
}