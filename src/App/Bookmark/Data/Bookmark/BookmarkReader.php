<?php
namespace Nemundo\Process\App\Bookmark\Data\Bookmark;
class BookmarkReader extends \Nemundo\Model\Reader\ModelDataReader {
/**
* @var BookmarkModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new BookmarkModel();
}
/**
* @return BookmarkRow[]
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
* @return BookmarkRow
*/
public function getRow() {
$dataRow = parent::getRow();
$row = $this->getModelRow($dataRow);
return $row;
}
/**
* @return BookmarkRow
*/
public function getRowById($id) {
return parent::getRowById($id);
}
private function getModelRow($dataRow) {
$row = new BookmarkRow($dataRow, $this->model);
$row->model = $this->model;
return $row;
}
}