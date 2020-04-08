<?php
namespace Nemundo\Process\App\Notification\Data\NotificationSource;
class NotificationSourceCount extends \Nemundo\Model\Count\AbstractModelDataCount {
/**
* @var NotificationSourceModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new NotificationSourceModel();
}
}