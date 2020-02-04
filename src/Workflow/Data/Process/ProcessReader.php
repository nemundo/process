<?php
namespace Nemundo\Process\Workflow\Data\Process;
class ProcessReader extends \Nemundo\Model\Reader\ModelDataReader {
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
$row = $this->getModelRow($dataRow);
$list[] = $row;
}
return $list;
}
/**
* @return \Nemundo\Process\Workflow\Row\ProcessCustomRow
*/
public function getRow() {
$dataRow = parent::getRow();
$row = $this->getModelRow($dataRow);
return $row;
}
/**
* @return \Nemundo\Process\Workflow\Row\ProcessCustomRow
*/
public function getRowById($id) {
return parent::getRowById($id);
}
private function getModelRow($dataRow) {
$row = new \Nemundo\Process\Workflow\Row\ProcessCustomRow($dataRow, $this->model);
$row->model = $this->model;
return $row;
}
}