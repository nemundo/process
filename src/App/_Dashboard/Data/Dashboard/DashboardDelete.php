<?php
namespace Nemundo\Process\App\Dashboard\Data\Dashboard;
class DashboardDelete extends \Nemundo\Model\Delete\AbstractModelDelete {
/**
* @var DashboardModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new DashboardModel();
}
}