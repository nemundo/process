<?php
namespace Nemundo\Process\App\Podcast\Data\Episode;
class EpisodeRow extends \Nemundo\Model\Row\AbstractModelDataRow {
/**
* @var \Nemundo\Model\Row\AbstractModelDataRow
*/
private $row;

/**
* @var EpisodeModel
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
* @var \Nemundo\Process\App\Podcast\Data\Feed\FeedRow
*/
public $podcast;

public function __construct(\Nemundo\Db\Row\AbstractDataRow $row, $model) {
parent::__construct($row->getData());
$this->row = $row;
$this->id = $this->getModelValue($model->id);
$this->podcastId = intval($this->getModelValue($model->podcastId));
if ($model->podcast !== null) {
$this->loadNemundoProcessAppPodcastDataFeedFeedpodcastRow($model->podcast);
}
}
private function loadNemundoProcessAppPodcastDataFeedFeedpodcastRow($model) {
$this->podcast = new \Nemundo\Process\App\Podcast\Data\Feed\FeedRow($this->row, $model);
}
}