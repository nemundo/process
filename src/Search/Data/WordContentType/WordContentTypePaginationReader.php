<?php
namespace Nemundo\Process\Search\Data\WordContentType;
class WordContentTypePaginationReader extends \Nemundo\Model\Reader\AbstractPaginationModelDataReader {
/**
* @var WordContentTypeModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new WordContentTypeModel();
}
/**
* @return WordContentTypeRow[]
*/
public function getData() {
$list = [];
foreach (parent::getData() as $dataRow) {
$row = new WordContentTypeRow($dataRow, $this->model);
$list[] = $row;
}
return $list;
}
}