<?php
namespace Nemundo\Process\App\Dashboard\Data\Dashboard;
class DashboardValue extends \Nemundo\Model\Value\AbstractModelDataValue {
/**
* @var DashboardModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new DashboardModel();
}
}