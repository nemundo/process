<?php
namespace Nemundo\Process\App\Assignment\Data\Assignment;
use Nemundo\Model\Id\AbstractModelIdValue;
class AssignmentId extends AbstractModelIdValue {
/**
* @var AssignmentModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new AssignmentModel();
}
}