<?php
namespace Nemundo\Process\App\Podcast\Data\PodcastEpisode;
class PodcastEpisode extends \Nemundo\Model\Data\AbstractModelData {
/**
* @var PodcastEpisodeModel
*/
protected $model;

/**
* @var string
*/
public $podcastId;

public function __construct() {
parent::__construct();
$this->model = new PodcastEpisodeModel();
}
public function save() {
$this->typeValueList->setModelValue($this->model->podcastId, $this->podcastId);
$id = parent::save();
return $id;
}
}