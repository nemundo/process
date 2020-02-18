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
* @return \Nemundo\Process\App\Notification\Row\NotificationCustomRow[]
*/
public function getData() {
$list = [];
foreach (parent::getData() as $dataRow) {
$row = $this->getModelRow($dataRow);
$list[] = $row;
}
return $list;
}
/**
* @return \Nemundo\Process\App\Notification\Row\NotificationCustomRow
*/
public function getRow() {
$dataRow = parent::getRow();
$row = $this->getModelRow($dataRow);
return $row;
}
/**
* @return \Nemundo\Process\App\Notification\Row\NotificationCustomRow
*/
public function getRowById($id) {
return parent::getRowById($id);
}
private function getModelRow($dataRow) {
$row = new \Nemundo\Process\App\Notification\Row\NotificationCustomRow($dataRow, $this->model);
$row->model = $this->model;
return $row;
}
}