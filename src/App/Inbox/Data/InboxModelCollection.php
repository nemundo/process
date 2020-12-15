<?php
namespace Nemundo\Process\App\Inbox\Data;
use Nemundo\Model\Collection\AbstractModelCollection;
class InboxModelCollection extends AbstractModelCollection {
protected function loadCollection() {
$this->addModel(new \Nemundo\Process\App\Inbox\Data\Inbox\InboxModel());
}
}