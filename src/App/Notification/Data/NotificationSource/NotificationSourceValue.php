<?php
namespace Nemundo\Process\App\Notification\Data\NotificationSource;
class NotificationSourceValue extends \Nemundo\Model\Value\AbstractModelDataValue {
/**
* @var NotificationSourceModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new NotificationSourceModel();
}
}