<?php
namespace Nemundo\Process\App\Podcast\Data\Podcast;
class PodcastCount extends \Nemundo\Model\Count\AbstractModelDataCount {
/**
* @var PodcastModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new PodcastModel();
}
}