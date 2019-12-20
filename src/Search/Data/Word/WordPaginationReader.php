<?php
namespace Nemundo\Process\Search\Data\Word;
class WordPaginationReader extends \Nemundo\Model\Reader\AbstractPaginationModelDataReader {
/**
* @var WordModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new WordModel();
}
/**
* @return WordRow[]
*/
public function getData() {
$list = [];
foreach (parent::getData() as $dataRow) {
$row = new WordRow($dataRow, $this->model);
$list[] = $row;
}
return $list;
}
}