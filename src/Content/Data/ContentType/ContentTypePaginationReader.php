<?php
namespace Nemundo\Process\Content\Data\ContentType;
class ContentTypePaginationReader extends \Nemundo\Model\Reader\AbstractPaginationModelDataReader {
/**
* @var ContentTypeModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new ContentTypeModel();
}
/**
* @return \Nemundo\Process\Row\ContentTypeCustomRow[]
*/
public function getData() {
$list = [];
foreach (parent::getData() as $dataRow) {
$row = new \Nemundo\Process\Row\ContentTypeCustomRow($dataRow, $this->model);
$list[] = $row;
}
return $list;
}
}