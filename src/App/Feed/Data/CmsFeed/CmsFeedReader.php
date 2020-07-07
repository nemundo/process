<?php
namespace Nemundo\Process\App\Feed\Data\CmsFeed;
class CmsFeedReader extends \Nemundo\Model\Reader\ModelDataReader {
/**
* @var CmsFeedModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new CmsFeedModel();
}
/**
* @return CmsFeedRow[]
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
* @return CmsFeedRow
*/
public function getRow() {
$dataRow = parent::getRow();
$row = $this->getModelRow($dataRow);
return $row;
}
/**
* @return CmsFeedRow
*/
public function getRowById($id) {
return parent::getRowById($id);
}
private function getModelRow($dataRow) {
$row = new CmsFeedRow($dataRow, $this->model);
$row->model = $this->model;
return $row;
}
}