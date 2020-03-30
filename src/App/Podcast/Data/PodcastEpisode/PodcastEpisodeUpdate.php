<?php
namespace Nemundo\Process\App\Podcast\Data\PodcastEpisode;
use Nemundo\Model\Data\AbstractModelUpdate;
class PodcastEpisodeUpdate extends AbstractModelUpdate {
/**
* @var PodcastEpisodeModel
*/
public $model;

/**
* @var string
*/
public $podcastId;

public function __construct() {
parent::__construct();
$this->model = new PodcastEpisodeModel();
}
public function update() {
$this->typeValueList->setModelValue($this->model->podcastId, $this->podcastId);
parent::update();
}
}