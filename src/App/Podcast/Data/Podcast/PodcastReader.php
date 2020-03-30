<?php
namespace Nemundo\Process\App\Podcast\Data\Podcast;
class PodcastReader extends \Nemundo\Model\Reader\ModelDataReader {
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
$row = $this->getModelRow($dataRow);
$list[] = $row;
}
return $list;
}
/**
* @return PodcastRow
*/
public function getRow() {
$dataRow = parent::getRow();
$row = $this->getModelRow($dataRow);
return $row;
}
/**
* @return PodcastRow
*/
public function getRowById($id) {
return parent::getRowById($id);
}
private function getModelRow($dataRow) {
$row = new PodcastRow($dataRow, $this->model);
$row->model = $this->model;
return $row;
}
}