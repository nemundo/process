<?php
namespace Nemundo\Process\App\Notification\Data\Notification;
class NotificationValue extends \Nemundo\Model\Value\AbstractModelDataValue {
/**
* @var NotificationModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new NotificationModel();
}
}