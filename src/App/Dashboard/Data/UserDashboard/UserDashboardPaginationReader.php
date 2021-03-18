<?php
namespace Nemundo\Process\App\Dashboard\Data\UserDashboard;
class UserDashboardPaginationReader extends \Nemundo\Model\Reader\AbstractPaginationModelDataReader {
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
$row = new UserDashboardRow($dataRow, $this->model);
$list[] = $row;
}
return $list;
}
}