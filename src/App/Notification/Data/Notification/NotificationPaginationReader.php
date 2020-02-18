<?php
namespace Nemundo\Process\App\Notification\Data\Notification;
class NotificationPaginationReader extends \Nemundo\Model\Reader\AbstractPaginationModelDataReader {
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
$row = new \Nemundo\Process\App\Notification\Row\NotificationCustomRow($dataRow, $this->model);
$list[] = $row;
}
return $list;
}
}