<?php
namespace Nemundo\Process\App\Notification\Data;
use Nemundo\Model\Collection\AbstractModelCollection;
class NotificationCollection extends AbstractModelCollection {
protected function loadCollection() {
$this->addModel(new \Nemundo\Process\App\Notification\Data\Notification\NotificationModel());
}
}