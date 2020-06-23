<?php
namespace Nemundo\Process\App\Video\Data\YouTube;
class YouTubeReader extends \Nemundo\Model\Reader\ModelDataReader {
/**
* @var YouTubeModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new YouTubeModel();
}
/**
* @return YouTubeRow[]
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
* @return YouTubeRow
*/
public function getRow() {
$dataRow = parent::getRow();
$row = $this->getModelRow($dataRow);
return $row;
}
/**
* @return YouTubeRow
*/
public function getRowById($id) {
return parent::getRowById($id);
}
private function getModelRow($dataRow) {
$row = new YouTubeRow($dataRow, $this->model);
$row->model = $this->model;
return $row;
}
}