<?php
namespace Nemundo\Process\App\Message\Data;
use Nemundo\Model\Collection\AbstractModelCollection;
class MessageCollection extends AbstractModelCollection {
protected function loadCollection() {
$this->addModel(new \Nemundo\Process\App\Message\Data\Message\MessageModel());
$this->addModel(new \Nemundo\Process\App\Message\Data\MessageTo\MessageToModel());
}
}