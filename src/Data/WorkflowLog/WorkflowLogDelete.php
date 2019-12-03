<?php
namespace Nemundo\Process\Data\WorkflowLog;
class WorkflowLogDelete extends \Nemundo\Model\Delete\AbstractModelDelete {
/**
* @var WorkflowLogModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new WorkflowLogModel();
}
}