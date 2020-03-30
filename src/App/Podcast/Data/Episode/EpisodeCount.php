<?php
namespace Nemundo\Process\App\Podcast\Data\Episode;
class EpisodeCount extends \Nemundo\Model\Count\AbstractModelDataCount {
/**
* @var EpisodeModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new EpisodeModel();
}
}