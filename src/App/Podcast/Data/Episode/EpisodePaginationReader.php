<?php
namespace Nemundo\Process\App\Podcast\Data\Episode;
class EpisodePaginationReader extends \Nemundo\Model\Reader\AbstractPaginationModelDataReader {
/**
* @var EpisodeModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new EpisodeModel();
}
/**
* @return EpisodeRow[]
*/
public function getData() {
$list = [];
foreach (parent::getData() as $dataRow) {
$row = new EpisodeRow($dataRow, $this->model);
$list[] = $row;
}
return $list;
}
}