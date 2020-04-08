<?php
namespace Nemundo\Process\App\Notification\Data\NotificationSource;
class NotificationSourceBulk extends \Nemundo\Model\Data\AbstractModelDataBulk {
/**
* @var NotificationSourceModel
*/
protected $model;

public function __construct() {
parent::__construct();
$this->model = new NotificationSourceModel();
}
public function save() {
$id = parent::save();
return $id;
}
}