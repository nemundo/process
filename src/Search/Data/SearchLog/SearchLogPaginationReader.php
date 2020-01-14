<?php
namespace Nemundo\Process\Search\Data\SearchLog;
class SearchLogPaginationReader extends \Nemundo\Model\Reader\AbstractPaginationModelDataReader {
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
$row = new SearchLogRow($dataRow, $this->model);
$list[] = $row;
}
return $list;
}
}