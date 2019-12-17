<?php
namespace Nemundo\Process\Content\Data\Content;
class ContentPaginationReader extends \Nemundo\Model\Reader\AbstractPaginationModelDataReader {
/**
* @var ContentModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new ContentModel();
}
/**
* @return ContentRow[]
*/
public function getData() {
$list = [];
foreach (parent::getData() as $dataRow) {
$row = new ContentRow($dataRow, $this->model);
$list[] = $row;
}
return $list;
}
}