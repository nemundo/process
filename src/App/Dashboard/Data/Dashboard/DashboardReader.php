<?php
namespace Nemundo\Process\App\Dashboard\Data\Dashboard;
class DashboardReader extends \Nemundo\Model\Reader\ModelDataReader {
/**
* @var DashboardModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new DashboardModel();
}
/**
* @return DashboardRow[]
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
* @return DashboardRow
*/
public function getRow() {
$dataRow = parent::getRow();
$row = $this->getModelRow($dataRow);
return $row;
}
/**
* @return DashboardRow
*/
public function getRowById($id) {
return parent::getRowById($id);
}
private function getModelRow($dataRow) {
$row = new DashboardRow($dataRow, $this->model);
$row->model = $this->model;
return $row;
}
}