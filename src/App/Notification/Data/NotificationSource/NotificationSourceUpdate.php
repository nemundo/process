<?php
namespace Nemundo\Process\App\Notification\Data\NotificationSource;
use Nemundo\Model\Data\AbstractModelUpdate;
class NotificationSourceUpdate extends AbstractModelUpdate {
/**
* @var NotificationSourceModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new NotificationSourceModel();
}
public function update() {
parent::update();
}
}