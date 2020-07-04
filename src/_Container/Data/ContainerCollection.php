<?php
namespace Nemundo\Process\Container\Data;
use Nemundo\Model\Collection\AbstractModelCollection;
class ContainerCollection extends AbstractModelCollection {
protected function loadCollection() {
$this->addModel(new \Nemundo\Process\Container\Data\Container\ContainerModel());
}
}