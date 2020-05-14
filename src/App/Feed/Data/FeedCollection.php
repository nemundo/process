<?php
namespace Nemundo\Process\App\Feed\Data;
use Nemundo\Model\Collection\AbstractModelCollection;
class FeedCollection extends AbstractModelCollection {
protected function loadCollection() {
$this->addModel(new \Nemundo\Process\App\Feed\Data\Feed\FeedModel());
$this->addModel(new \Nemundo\Process\App\Feed\Data\FeedItem\FeedItemModel());
}
}