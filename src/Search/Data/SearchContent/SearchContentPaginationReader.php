<?php
namespace Nemundo\Process\Search\Data\SearchContent;
class SearchContentPaginationReader extends \Nemundo\Model\Reader\AbstractPaginationModelDataReader {
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
$row = new SearchContentRow($dataRow, $this->model);
$list[] = $row;
}
return $list;
}
}