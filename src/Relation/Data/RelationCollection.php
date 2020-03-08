<?php
namespace Nemundo\Process\Relation\Data;
use Nemundo\Model\Collection\AbstractModelCollection;
class RelationCollection extends AbstractModelCollection {
protected function loadCollection() {
$this->addModel(new \Nemundo\Process\Relation\Data\Relation\RelationModel());
}
}