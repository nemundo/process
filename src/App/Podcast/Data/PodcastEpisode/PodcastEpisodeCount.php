<?php
namespace Nemundo\Process\App\Podcast\Data\PodcastEpisode;
class PodcastEpisodeCount extends \Nemundo\Model\Count\AbstractModelDataCount {
/**
* @var PodcastEpisodeModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new PodcastEpisodeModel();
}
}