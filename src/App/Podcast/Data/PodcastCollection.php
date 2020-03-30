<?php
namespace Nemundo\Process\App\Podcast\Data;
use Nemundo\Model\Collection\AbstractModelCollection;
class PodcastCollection extends AbstractModelCollection {
protected function loadCollection() {
$this->addModel(new \Nemundo\Process\App\Podcast\Data\Episode\EpisodeModel());
$this->addModel(new \Nemundo\Process\App\Podcast\Data\Feed\FeedModel());
}
}