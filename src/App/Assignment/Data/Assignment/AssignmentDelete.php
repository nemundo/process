<?php
namespace Nemundo\Process\App\Assignment\Data\Assignment;
class AssignmentDelete extends \Nemundo\Model\Delete\AbstractModelDelete {
/**
* @var AssignmentModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new AssignmentModel();
}
}