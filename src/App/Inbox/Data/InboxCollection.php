<?php
namespace Nemundo\Process\App\Inbox\Data;
use Nemundo\Model\Collection\AbstractModelCollection;
class InboxCollection extends AbstractModelCollection {
protected function loadCollection() {
$this->addModel(new \Nemundo\Process\App\Inbox\Data\Inbox\InboxModel());
}
}