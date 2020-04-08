<?php
namespace Nemundo\Process\App\Notification\Data\NotificationSource;
use Nemundo\Model\Id\AbstractModelIdValue;
class NotificationSourceId extends AbstractModelIdValue {
/**
* @var NotificationSourceModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new NotificationSourceModel();
}
}