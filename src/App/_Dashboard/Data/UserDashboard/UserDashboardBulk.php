<?php
namespace Nemundo\Process\App\Dashboard\Data\UserDashboard;
class UserDashboardBulk extends \Nemundo\Model\Data\AbstractModelDataBulk {
/**
* @var UserDashboardModel
*/
protected $model;

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
public function save() {
$this->typeValueList->setModelValue($this->model->userId, $this->userId);
$this->typeValueList->setModelValue($this->model->dashboardId, $this->dashboardId);
$this->typeValueList->setModelValue($this->model->itemOrder, $this->itemOrder);
$id = parent::save();
return $id;
}
}