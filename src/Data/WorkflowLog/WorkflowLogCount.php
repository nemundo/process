<?php
namespace Nemundo\Process\Data\WorkflowLog;
class WorkflowLogCount extends \Nemundo\Model\Count\AbstractModelDataCount {
/**
* @var WorkflowLogModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new WorkflowLogModel();
}
}