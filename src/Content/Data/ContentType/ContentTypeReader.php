<?php
namespace Nemundo\Process\Content\Data\ContentType;
class ContentTypeReader extends \Nemundo\Model\Reader\ModelDataReader {
/**
* @var ContentTypeModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new ContentTypeModel();
}
/**
* @return \Nemundo\Process\Content\Row\ContentTypeCustomRow[]
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
* @return \Nemundo\Process\Content\Row\ContentTypeCustomRow
*/
public function getRow() {
$dataRow = parent::getRow();
$row = $this->getModelRow($dataRow);
return $row;
}
/**
* @return \Nemundo\Process\Content\Row\ContentTypeCustomRow
*/
public function getRowById($id) {
return parent::getRowById($id);
}
private function getModelRow($dataRow) {
$row = new \Nemundo\Process\Content\Row\ContentTypeCustomRow($dataRow, $this->model);
$row->model = $this->model;
return $row;
}
}