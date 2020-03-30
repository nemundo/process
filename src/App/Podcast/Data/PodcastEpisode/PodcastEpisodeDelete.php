<?php
namespace Nemundo\Process\App\Podcast\Data\PodcastEpisode;
class PodcastEpisodeDelete extends \Nemundo\Model\Delete\AbstractModelDelete {
/**
* @var PodcastEpisodeModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new PodcastEpisodeModel();
}
}