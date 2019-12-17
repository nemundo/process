<?php
namespace Nemundo\Process\Workflow\Data\Status;
class StatusReader extends \Nemundo\Model\Reader\ModelDataReader {
/**
* @var StatusModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new StatusModel();
}
/**
* @return \Nemundo\Process\Workflow\Row\StatusCustomRow[]
*/
public function getData() {
$this->addFieldByModel($this->model);
$this->checkExternal($this->model);
$list = [];
foreach (parent::getData() as $dataRow) {
$row = $this->getModelRow($dataRow);
$list[] = $row;
}
return $list;
}
/**
* @return \Nemundo\Process\Workflow\Row\StatusCustomRow
*/
public function getRow() {
$this->addFieldByModel($this->model);
$this->checkExternal($this->model);
$dataRow = parent::getRow();
$row = $this->getModelRow($dataRow);
return $row;
}
/**
* @return \Nemundo\Process\Workflow\Row\StatusCustomRow
*/
public function getRowById($id) {
return parent::getRowById($id);
}
private function getModelRow($dataRow) {
$row = new \Nemundo\Process\Workflow\Row\StatusCustomRow($dataRow, $this->model);
$row->model = $this->model;
return $row;
}
}