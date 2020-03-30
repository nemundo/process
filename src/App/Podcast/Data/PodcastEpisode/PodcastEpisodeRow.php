<?php
namespace Nemundo\Process\App\Podcast\Data\PodcastEpisode;
class PodcastEpisodeRow extends \Nemundo\Model\Row\AbstractModelDataRow {
/**
* @var \Nemundo\Model\Row\AbstractModelDataRow
*/
private $row;

/**
* @var PodcastEpisodeModel
*/
public $model;

/**
* @var string
*/
public $id;

/**
* @var int
*/
public $podcastId;

/**
* @var \Nemundo\Process\App\Podcast\Data\Podcast\PodcastRow
*/
public $podcast;

public function __construct(\Nemundo\Db\Row\AbstractDataRow $row, $model) {
parent::__construct($row->getData());
$this->row = $row;
$this->id = $this->getModelValue($model->id);
$this->podcastId = intval($this->getModelValue($model->podcastId));
if ($model->podcast !== null) {
$this->loadNemundoProcessAppPodcastDataPodcastPodcastpodcastRow($model->podcast);
}
}
private function loadNemundoProcessAppPodcastDataPodcastPodcastpodcastRow($model) {
$this->podcast = new \Nemundo\Process\App\Podcast\Data\Podcast\PodcastRow($this->row, $model);
}
}