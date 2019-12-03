<?php
namespace Nemundo\Process\Data\WorkflowLog;
use Nemundo\Model\Id\AbstractModelIdValue;
class WorkflowLogId extends AbstractModelIdValue {
/**
* @var WorkflowLogModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new WorkflowLogModel();
}
}