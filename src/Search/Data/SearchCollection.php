<?php
namespace Nemundo\Process\Search\Data;
use Nemundo\Model\Collection\AbstractModelCollection;
class SearchCollection extends AbstractModelCollection {
protected function loadCollection() {
$this->addModel(new \Nemundo\Process\Search\Data\SearchIndex\SearchIndexModel());
$this->addModel(new \Nemundo\Process\Search\Data\Word\WordModel());
}
}