<?php
namespace Nemundo\Process\App\Assignment\Data\AssignmentSource;
use Nemundo\Model\Id\AbstractModelIdValue;
class AssignmentSourceId extends AbstractModelIdValue {
/**
* @var AssignmentSourceModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new AssignmentSourceModel();
}
}