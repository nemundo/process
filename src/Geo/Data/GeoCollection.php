<?php
namespace Nemundo\Process\Geo\Data;
use Nemundo\Model\Collection\AbstractModelCollection;
class GeoCollection extends AbstractModelCollection {
protected function loadCollection() {
$this->addModel(new \Nemundo\Process\Geo\Data\Geo\GeoModel());
}
}