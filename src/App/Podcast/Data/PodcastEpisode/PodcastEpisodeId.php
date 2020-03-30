<?php
namespace Nemundo\Process\App\Podcast\Data\PodcastEpisode;
use Nemundo\Model\Id\AbstractModelIdValue;
class PodcastEpisodeId extends AbstractModelIdValue {
/**
* @var PodcastEpisodeModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new PodcastEpisodeModel();
}
}