<?php
namespace Nemundo\Process\App\Bookmark\Data;
use Nemundo\Model\Collection\AbstractModelCollection;
class BookmarkCollection extends AbstractModelCollection {
protected function loadCollection() {
$this->addModel(new \Nemundo\Process\App\Bookmark\Data\Bookmark\BookmarkModel());
}
}