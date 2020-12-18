<?php
namespace Nemundo\Process\App\Dashboard\Data\UserDashboard;
class UserDashboardRow extends \Nemundo\Model\Row\AbstractModelDataRow {
/**
* @var \Nemundo\Model\Row\AbstractModelDataRow
*/
private $row;

/**
* @var UserDashboardModel
*/
public $model;

/**
* @var string
*/
public $id;

/**
* @var int
*/
public $userId;

/**
* @var \Nemundo\User\Data\User\UserRow
*/
public $user;

/**
* @var int
*/
public $dashboardId;

/**
* @var \Nemundo\Process\Content\Row\ContentCustomRow
*/
public $dashboard;

/**
* @var int
*/
public $itemOrder;

public function __construct(\Nemundo\Db\Row\AbstractDataRow $row, $model) {
parent::__construct($row->getData());
$this->row = $row;
$this->id = $this->getModelValue($model->id);
$this->userId = intval($this->getModelValue($model->userId));
if ($model->user !== null) {
$this->loadNemundoUserDataUserUseruserRow($model->user);
}
$this->dashboardId = intval($this->getModelValue($model->dashboardId));
if ($model->dashboard !== null) {
$this->loadNemundoProcessContentDataContentContentdashboardRow($model->dashboard);
}
$this->itemOrder = intval($this->getModelValue($model->itemOrder));
}
private function loadNemundoUserDataUserUseruserRow($model) {
$this->user = new \Nemundo\User\Data\User\UserRow($this->row, $model);
}
private function loadNemundoProcessContentDataContentContentdashboardRow($model) {
$this->dashboard = new \Nemundo\Process\Content\Row\ContentCustomRow($this->row, $model);
}
}