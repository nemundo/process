<?php
namespace Nemundo\Process\App\Notification\Data;
use Nemundo\Model\Collection\AbstractModelCollection;
class NotificationModelCollection extends AbstractModelCollection {
protected function loadCollection() {
$this->addModel(new \Nemundo\Process\App\Notification\Data\Category\CategoryModel());
$this->addModel(new \Nemundo\Process\App\Notification\Data\Notification\NotificationModel());
$this->addModel(new \Nemundo\Process\App\Notification\Data\NotificationSource\NotificationSourceModel());
}
}