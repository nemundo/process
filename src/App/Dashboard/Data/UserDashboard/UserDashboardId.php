<?php
namespace Nemundo\Process\App\Dashboard\Data\UserDashboard;
use Nemundo\Model\Id\AbstractModelIdValue;
class UserDashboardId extends AbstractModelIdValue {
/**
* @var UserDashboardModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new UserDashboardModel();
}
}