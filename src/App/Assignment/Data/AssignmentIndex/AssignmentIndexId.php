<?php
namespace Nemundo\Process\App\Assignment\Data\AssignmentIndex;
use Nemundo\Model\Id\AbstractModelIdValue;
class AssignmentIndexId extends AbstractModelIdValue {
/**
* @var AssignmentIndexModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new AssignmentIndexModel();
}
}