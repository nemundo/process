<?php
namespace Nemundo\Process\App\Video\Data;
use Nemundo\Model\Collection\AbstractModelCollection;
class VideoCollection extends AbstractModelCollection {
protected function loadCollection() {
$this->addModel(new \Nemundo\Process\App\Video\Data\YouTube\YouTubeModel());
}
}