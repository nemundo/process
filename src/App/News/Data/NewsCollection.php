<?php
namespace Nemundo\Process\App\News\Data;
use Nemundo\Model\Collection\AbstractModelCollection;
class NewsCollection extends AbstractModelCollection {
protected function loadCollection() {
$this->addModel(new \Nemundo\Process\App\News\Data\News\NewsModel());
}
}