<?php
namespace Nemundo\Process\Workflow\Data\Process;
class ProcessPaginationReader extends \Nemundo\Model\Reader\AbstractPaginationModelDataReader {
/**
* @var ProcessModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new ProcessModel();
}
/**
* @return \Nemundo\Process\Workflow\Row\ProcessCustomRow[]
*/
public function getData() {
$list = [];
foreach (parent::getData() as $dataRow) {
$row = new \Nemundo\Process\Workflow\Row\ProcessCustomRow($dataRow, $this->model);
$list[] = $row;
}
return $list;
}
}