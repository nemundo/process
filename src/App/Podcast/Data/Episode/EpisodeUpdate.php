<?php
namespace Nemundo\Process\App\Podcast\Data\Episode;
use Nemundo\Model\Data\AbstractModelUpdate;
class EpisodeUpdate extends AbstractModelUpdate {
/**
* @var EpisodeModel
*/
public $model;

/**
* @var string
*/
public $podcastId;

public function __construct() {
parent::__construct();
$this->model = new EpisodeModel();
}
public function update() {
$this->typeValueList->setModelValue($this->model->podcastId, $this->podcastId);
parent::update();
}
}