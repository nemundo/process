<?php
namespace Nemundo\Process\App\Dashboard\Data\UserDashboard;
class UserDashboardModel extends \Nemundo\Model\Definition\Model\AbstractModel {
/**
* @var \Nemundo\Model\Type\Id\IdType
*/
public $id;

/**
* @var \Nemundo\Model\Type\External\Id\ExternalIdType
*/
public $userId;

/**
* @var \Nemundo\User\Data\User\UserExternalType
*/
public $user;

/**
* @var \Nemundo\Model\Type\External\Id\ExternalIdType
*/
public $dashboardId;

/**
* @var \Nemundo\Process\Content\Data\Content\ContentExternalType
*/
public $dashboard;

/**
* @var \Nemundo\Model\Type\Number\NumberType
*/
public $itemOrder;

protected function loadModel() {
$this->tableName = "dashboard_user_dashboard";
$this->aliasTableName = "dashboard_user_dashboard";
$this->label = "User Dashboard";

$this->primaryIndex = new \Nemundo\Db\Index\AutoIncrementIdPrimaryIndex();

$this->id = new \Nemundo\Model\Type\Id\IdType($this);
$this->id->tableName = "dashboard_user_dashboard";
$this->id->fieldName = "id";
$this->id->aliasFieldName = "dashboard_user_dashboard_id";
$this->id->label = "Id";
$this->id->allowNullValue = false;
$this->id->visible->form = false;
$this->id->visible->table = false;
$this->id->visible->view = false;
$this->id->visible->form = false;

$this->userId = new \Nemundo\Model\Type\External\Id\ExternalIdType($this);
$this->userId->tableName = "dashboard_user_dashboard";
$this->userId->fieldName = "user";
$this->userId->aliasFieldName = "dashboard_user_dashboard_user";
$this->userId->label = "User";
$this->userId->allowNullValue = false;

$this->dashboardId = new \Nemundo\Model\Type\External\Id\ExternalIdType($this);
$this->dashboardId->tableName = "dashboard_user_dashboard";
$this->dashboardId->fieldName = "dashboard";
$this->dashboardId->aliasFieldName = "dashboard_user_dashboard_dashboard";
$this->dashboardId->label = "Dashboard";
$this->dashboardId->allowNullValue = false;

$this->itemOrder = new \Nemundo\Model\Type\Number\NumberType($this);
$this->itemOrder->tableName = "dashboard_user_dashboard";
$this->itemOrder->fieldName = "item_order";
$this->itemOrder->aliasFieldName = "dashboard_user_dashboard_item_order";
$this->itemOrder->label = "Item Order";
$this->itemOrder->allowNullValue = false;

$index = new \Nemundo\Model\Definition\Index\ModelIndex($this);
$index->indexName = "user";
$index->addType($this->userId);

}
public function loadUser() {
if ($this->user == null) {
$this->user = new \Nemundo\User\Data\User\UserExternalType($this, "dashboard_user_dashboard_user");
$this->user->tableName = "dashboard_user_dashboard";
$this->user->fieldName = "user";
$this->user->aliasFieldName = "dashboard_user_dashboard_user";
$this->user->label = "User";
}
return $this;
}
public function loadDashboard() {
if ($this->dashboard == null) {
$this->dashboard = new \Nemundo\Process\Content\Data\Content\ContentExternalType($this, "dashboard_user_dashboard_dashboard");
$this->dashboard->tableName = "dashboard_user_dashboard";
$this->dashboard->fieldName = "dashboard";
$this->dashboard->aliasFieldName = "dashboard_user_dashboard_dashboard";
$this->dashboard->label = "Dashboard";
}
return $this;
}
}