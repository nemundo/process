<?php
namespace Nemundo\Process\App\Notification\Data\NotificationSource;
class NotificationSourcePaginationReader extends \Nemundo\Model\Reader\AbstractPaginationModelDataReader {
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
$row = new NotificationSourceRow($dataRow, $this->model);
$list[] = $row;
}
return $list;
}
}