<?php
namespace Nemundo\Process\App\Dashboard\Data\Dashboard;
class DashboardCount extends \Nemundo\Model\Count\AbstractModelDataCount {
/**
* @var DashboardModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new DashboardModel();
}
}