<?php
namespace Nemundo\Process\Cms\Data\CmsType;
class CmsTypeReader extends \Nemundo\Model\Reader\ModelDataReader {
/**
* @var CmsTypeModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new CmsTypeModel();
}
/**
* @return CmsTypeRow[]
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
* @return CmsTypeRow
*/
public function getRow() {
$dataRow = parent::getRow();
$row = $this->getModelRow($dataRow);
return $row;
}
/**
* @return CmsTypeRow
*/
public function getRowById($id) {
return parent::getRowById($id);
}
private function getModelRow($dataRow) {
$row = new CmsTypeRow($dataRow, $this->model);
$row->model = $this->model;
return $row;
}
}