<?php
namespace Nemundo\Process\App\Podcast\Data\PodcastEpisode;
class PodcastEpisodeBulk extends \Nemundo\Model\Data\AbstractModelDataBulk {
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