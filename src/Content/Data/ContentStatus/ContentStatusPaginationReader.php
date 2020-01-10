<?php
namespace Nemundo\Process\Content\Data\ContentStatus;
class ContentStatusPaginationReader extends \Nemundo\Model\Reader\AbstractPaginationModelDataReader {
/**
* @var ContentStatusModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new ContentStatusModel();
}
/**
* @return ContentStatusRow[]
*/
public function getData() {
$list = [];
foreach (parent::getData() as $dataRow) {
$row = new ContentStatusRow($dataRow, $this->model);
$list[] = $row;
}
return $list;
}
}