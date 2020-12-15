<?php
namespace Nemundo\Process\App\Stream\Data;
use Nemundo\Model\Collection\AbstractModelCollection;
class StreamModelCollection extends AbstractModelCollection {
protected function loadCollection() {
$this->addModel(new \Nemundo\Process\App\Stream\Data\Stream\StreamModel());
$this->addModel(new \Nemundo\Process\App\Stream\Data\UserStream\UserStreamModel());
}
}