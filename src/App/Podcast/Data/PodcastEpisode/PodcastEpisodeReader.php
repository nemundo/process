<?php
namespace Nemundo\Process\App\Podcast\Data\PodcastEpisode;
class PodcastEpisodeReader extends \Nemundo\Model\Reader\ModelDataReader {
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
$row = $this->getModelRow($dataRow);
$list[] = $row;
}
return $list;
}
/**
* @return PodcastEpisodeRow
*/
public function getRow() {
$dataRow = parent::getRow();
$row = $this->getModelRow($dataRow);
return $row;
}
/**
* @return PodcastEpisodeRow
*/
public function getRowById($id) {
return parent::getRowById($id);
}
private function getModelRow($dataRow) {
$row = new PodcastEpisodeRow($dataRow, $this->model);
$row->model = $this->model;
return $row;
}
}