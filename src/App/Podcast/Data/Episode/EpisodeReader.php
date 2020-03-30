<?php
namespace Nemundo\Process\App\Podcast\Data\Episode;
class EpisodeReader extends \Nemundo\Model\Reader\ModelDataReader {
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
$row = $this->getModelRow($dataRow);
$list[] = $row;
}
return $list;
}
/**
* @return EpisodeRow
*/
public function getRow() {
$dataRow = parent::getRow();
$row = $this->getModelRow($dataRow);
return $row;
}
/**
* @return EpisodeRow
*/
public function getRowById($id) {
return parent::getRowById($id);
}
private function getModelRow($dataRow) {
$row = new EpisodeRow($dataRow, $this->model);
$row->model = $this->model;
return $row;
}
}