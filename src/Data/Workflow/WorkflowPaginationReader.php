<?php
namespace Nemundo\Process\Data\Workflow;
class WorkflowPaginationReader extends \Nemundo\Model\Reader\AbstractPaginationModelDataReader {
/**
* @var WorkflowModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new WorkflowModel();
}
/**
* @return \Nemundo\Process\Row\WorkflowCustomRow[]
*/
public function getData() {
$list = [];
foreach (parent::getData() as $dataRow) {
$row = new \Nemundo\Process\Row\WorkflowCustomRow($dataRow, $this->model);
$list[] = $row;
}
return $list;
}
}