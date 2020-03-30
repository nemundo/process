<?php
namespace Nemundo\Process\App\Podcast\Data\Episode;
class Episode extends \Nemundo\Model\Data\AbstractModelData {
/**
* @var EpisodeModel
*/
protected $model;

/**
* @var string
*/
public $podcastId;

public function __construct() {
parent::__construct();
$this->model = new EpisodeModel();
}
public function save() {
$this->typeValueList->setModelValue($this->model->podcastId, $this->podcastId);
$id = parent::save();
return $id;
}
}