<?php
namespace Nemundo\Process\App\Plz\Data;
use Nemundo\Model\Collection\AbstractModelCollection;
class PlzCollection extends AbstractModelCollection {
protected function loadCollection() {
$this->addModel(new \Nemundo\Process\App\Plz\Data\Plz\PlzModel());
}
}