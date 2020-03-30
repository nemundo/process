<?php
namespace Nemundo\Process\App\Podcast\Data\Podcast;
class PodcastPaginationReader extends \Nemundo\Model\Reader\AbstractPaginationModelDataReader {
/**
* @var PodcastModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new PodcastModel();
}
/**
* @return PodcastRow[]
*/
public function getData() {
$list = [];
foreach (parent::getData() as $dataRow) {
$row = new PodcastRow($dataRow, $this->model);
$list[] = $row;
}
return $list;
}
}