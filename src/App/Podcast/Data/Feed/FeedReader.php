<?php
namespace Nemundo\Process\App\Podcast\Data\Feed;
class FeedReader extends \Nemundo\Model\Reader\ModelDataReader {
/**
* @var FeedModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new FeedModel();
}
/**
* @return FeedRow[]
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
* @return FeedRow
*/
public function getRow() {
$dataRow = parent::getRow();
$row = $this->getModelRow($dataRow);
return $row;
}
/**
* @return FeedRow
*/
public function getRowById($id) {
return parent::getRowById($id);
}
private function getModelRow($dataRow) {
$row = new FeedRow($dataRow, $this->model);
$row->model = $this->model;
return $row;
}
}