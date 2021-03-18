<?php
namespace Nemundo\Process\App\Bookmark\Data\Bookmark;
class BookmarkPaginationReader extends \Nemundo\Model\Reader\AbstractPaginationModelDataReader {
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
$row = new BookmarkRow($dataRow, $this->model);
$list[] = $row;
}
return $list;
}
}