<?php
namespace Nemundo\Process\Search\Data\SearchLog;
class SearchLogReader extends \Nemundo\Model\Reader\ModelDataReader {
/**
* @var SearchLogModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new SearchLogModel();
}
/**
* @return SearchLogRow[]
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
* @return SearchLogRow
*/
public function getRow() {
$dataRow = parent::getRow();
$row = $this->getModelRow($dataRow);
return $row;
}
/**
* @return SearchLogRow
*/
public function getRowById($id) {
return parent::getRowById($id);
}
private function getModelRow($dataRow) {
$row = new SearchLogRow($dataRow, $this->model);
$row->model = $this->model;
return $row;
}
}