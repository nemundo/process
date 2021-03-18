<?php
namespace Nemundo\Process\App\Dashboard\Data\Dashboard;
use Nemundo\Model\Id\AbstractModelIdValue;
class DashboardId extends AbstractModelIdValue {
/**
* @var DashboardModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new DashboardModel();
}
}