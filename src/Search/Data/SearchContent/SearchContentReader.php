<?php
namespace Nemundo\Process\Search\Data\SearchContent;
class SearchContentReader extends \Nemundo\Model\Reader\ModelDataReader {
/**
* @var SearchContentModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new SearchContentModel();
}
/**
* @return SearchContentRow[]
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
* @return SearchContentRow
*/
public function getRow() {
$dataRow = parent::getRow();
$row = $this->getModelRow($dataRow);
return $row;
}
/**
* @return SearchContentRow
*/
public function getRowById($id) {
return parent::getRowById($id);
}
private function getModelRow($dataRow) {
$row = new SearchContentRow($dataRow, $this->model);
$row->model = $this->model;
return $row;
}
}