<?php
namespace Nemundo\Process\App\Assignment\Data\AssignmentSource;
class AssignmentSourceDelete extends \Nemundo\Model\Delete\AbstractModelDelete {
/**
* @var AssignmentSourceModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new AssignmentSourceModel();
}
}