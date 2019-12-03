<?php
namespace Nemundo\Process\Data\WorkflowLog;
class WorkflowLogPaginationReader extends \Nemundo\Model\Reader\AbstractPaginationModelDataReader {
/**
* @var WorkflowLogModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new WorkflowLogModel();
}
/**
* @return WorkflowLogRow[]
*/
public function getData() {
$list = [];
foreach (parent::getData() as $dataRow) {
$row = new WorkflowLogRow($dataRow, $this->model);
$list[] = $row;
}
return $list;
}
}