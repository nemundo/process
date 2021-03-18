<?php
namespace Nemundo\Process\App\Dashboard\Data\UserDashboard;
class UserDashboardValue extends \Nemundo\Model\Value\AbstractModelDataValue {
/**
* @var UserDashboardModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new UserDashboardModel();
}
}