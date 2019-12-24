<?php
namespace Nemundo\Process\Content\Data\ContentGroup;
class ContentGroupPaginationReader extends \Nemundo\Model\Reader\AbstractPaginationModelDataReader {
/**
* @var ContentGroupModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new ContentGroupModel();
}
/**
* @return ContentGroupRow[]
*/
public function getData() {
$list = [];
foreach (parent::getData() as $dataRow) {
$row = new ContentGroupRow($dataRow, $this->model);
$list[] = $row;
}
return $list;
}
}