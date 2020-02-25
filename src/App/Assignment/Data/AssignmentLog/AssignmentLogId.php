<?php
namespace Nemundo\Process\App\Assignment\Data\AssignmentLog;
use Nemundo\Model\Id\AbstractModelIdValue;
class AssignmentLogId extends AbstractModelIdValue {
/**
* @var AssignmentLogModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new AssignmentLogModel();
}
}