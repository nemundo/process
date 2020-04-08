<?php
namespace Nemundo\Process\App\Notification\Data\NotificationSource;
class NotificationSourceReader extends \Nemundo\Model\Reader\ModelDataReader {
/**
* @var NotificationSourceModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new NotificationSourceModel();
}
/**
* @return NotificationSourceRow[]
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
* @return NotificationSourceRow
*/
public function getRow() {
$dataRow = parent::getRow();
$row = $this->getModelRow($dataRow);
return $row;
}
/**
* @return NotificationSourceRow
*/
public function getRowById($id) {
return parent::getRowById($id);
}
private function getModelRow($dataRow) {
$row = new NotificationSourceRow($dataRow, $this->model);
$row->model = $this->model;
return $row;
}
}