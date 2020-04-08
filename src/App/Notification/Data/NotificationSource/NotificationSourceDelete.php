<?php
namespace Nemundo\Process\App\Notification\Data\NotificationSource;
class NotificationSourceDelete extends \Nemundo\Model\Delete\AbstractModelDelete {
/**
* @var NotificationSourceModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new NotificationSourceModel();
}
}