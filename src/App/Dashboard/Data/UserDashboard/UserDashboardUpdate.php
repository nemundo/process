<?php
namespace Nemundo\Process\App\Dashboard\Data\UserDashboard;
use Nemundo\Model\Data\AbstractModelUpdate;
class UserDashboardUpdate extends AbstractModelUpdate {
/**
* @var UserDashboardModel
*/
public $model;

/**
* @var string
*/
public $userId;

/**
* @var string
*/
public $dashboardId;

/**
* @var int
*/
public $itemOrder;

public function __construct() {
parent::__construct();
$this->model = new UserDashboardModel();
}
public function update() {
$this->typeValueList->setModelValue($this->model->userId, $this->userId);
$this->typeValueList->setModelValue($this->model->dashboardId, $this->dashboardId);
$this->typeValueList->setModelValue($this->model->itemOrder, $this->itemOrder);
parent::update();
}
}