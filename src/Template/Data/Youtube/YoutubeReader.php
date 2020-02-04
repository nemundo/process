<?php
namespace Nemundo\Process\Template\Data\Youtube;
class YoutubeReader extends \Nemundo\Model\Reader\ModelDataReader {
/**
* @var YoutubeModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new YoutubeModel();
}
/**
* @return YoutubeRow[]
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
* @return YoutubeRow
*/
public function getRow() {
$dataRow = parent::getRow();
$row = $this->getModelRow($dataRow);
return $row;
}
/**
* @return YoutubeRow
*/
public function getRowById($id) {
return parent::getRowById($id);
}
private function getModelRow($dataRow) {
$row = new YoutubeRow($dataRow, $this->model);
$row->model = $this->model;
return $row;
}
}