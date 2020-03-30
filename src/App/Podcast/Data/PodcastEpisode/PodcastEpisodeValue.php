<?php
namespace Nemundo\Process\App\Podcast\Data\PodcastEpisode;
class PodcastEpisodeValue extends \Nemundo\Model\Value\AbstractModelDataValue {
/**
* @var PodcastEpisodeModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new PodcastEpisodeModel();
}
}