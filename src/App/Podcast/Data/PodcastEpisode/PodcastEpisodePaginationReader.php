<?php
namespace Nemundo\Process\App\Podcast\Data\PodcastEpisode;
class PodcastEpisodePaginationReader extends \Nemundo\Model\Reader\AbstractPaginationModelDataReader {
/**
* @var PodcastEpisodeModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new PodcastEpisodeModel();
}
/**
* @return PodcastEpisodeRow[]
*/
public function getData() {
$list = [];
foreach (parent::getData() as $dataRow) {
$row = new PodcastEpisodeRow($dataRow, $this->model);
$list[] = $row;
}
return $list;
}
}