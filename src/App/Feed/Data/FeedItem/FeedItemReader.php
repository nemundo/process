<?php
namespace Nemundo\Process\App\Feed\Data\FeedItem;
class FeedItemReader extends \Nemundo\Model\Reader\ModelDataReader {
/**
* @var FeedItemModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new FeedItemModel();
}
/**
* @return FeedItemRow[]
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
* @return FeedItemRow
*/
public function getRow() {
$dataRow = parent::getRow();
$row = $this->getModelRow($dataRow);
return $row;
}
/**
* @return FeedItemRow
*/
public function getRowById($id) {
return parent::getRowById($id);
}
private function getModelRow($dataRow) {
$row = new FeedItemRow($dataRow, $this->model);
$row->model = $this->model;
return $row;
}
}