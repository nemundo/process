<?php
namespace Nemundo\Process\App\Assignment\Data\AssignmentSource;
class AssignmentSourceValue extends \Nemundo\Model\Value\AbstractModelDataValue {
/**
* @var AssignmentSourceModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new AssignmentSourceModel();
}
}