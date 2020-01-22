<?php
namespace Nemundo\Process\App\Notification\Data\Notification;
class NotificationReader extends \Nemundo\Model\Reader\ModelDataReader {
/**
* @var NotificationModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new NotificationModel();
}
/**
* @return NotificationRow[]
*/
public function getData() {
$this->addFieldByModel($this->model);
$this->checkExternal($this->model);
$list = [];
foreach (parent::getData() as $dataRow) {
$row = $this->getModelRow($dataRow);
$list[] = $row;
}
return $list;
}
/**
* @return NotificationRow
*/
public function getRow() {
$this->addFieldByModel($this->model);
$this->checkExternal($this->model);
$dataRow = parent::getRow();
$row = $this->getModelRow($dataRow);
return $row;
}
/**
* @return NotificationRow
*/
public function getRowById($id) {
return parent::getRowById($id);
}
private function getModelRow($dataRow) {
$row = new NotificationRow($dataRow, $this->model);
$row->model = $this->model;
return $row;
}
}