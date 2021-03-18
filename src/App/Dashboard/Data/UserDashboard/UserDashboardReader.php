<?php
namespace Nemundo\Process\App\Dashboard\Data\UserDashboard;
class UserDashboardReader extends \Nemundo\Model\Reader\ModelDataReader {
/**
* @var UserDashboardModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new UserDashboardModel();
}
/**
* @return UserDashboardRow[]
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
* @return UserDashboardRow
*/
public function getRow() {
$dataRow = parent::getRow();
$row = $this->getModelRow($dataRow);
return $row;
}
/**
* @return UserDashboardRow
*/
public function getRowById($id) {
return parent::getRowById($id);
}
private function getModelRow($dataRow) {
$row = new UserDashboardRow($dataRow, $this->model);
$row->model = $this->model;
return $row;
}
}