<?php
namespace Nemundo\Process\App\WebLog\Data;
use Nemundo\Model\Collection\AbstractModelCollection;
class WebLogCollection extends AbstractModelCollection {
protected function loadCollection() {
$this->addModel(new \Nemundo\Process\App\WebLog\Data\WebLog\WebLogModel());
}
}