<?php
namespace Nemundo\Process\Cms\Data\Cms;
class CmsReader extends \Nemundo\Model\Reader\ModelDataReader {
/**
* @var CmsModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new CmsModel();
}
/**
* @return CmsRow[]
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
* @return CmsRow
*/
public function getRow() {
$dataRow = parent::getRow();
$row = $this->getModelRow($dataRow);
return $row;
}
/**
* @return CmsRow
*/
public function getRowById($id) {
return parent::getRowById($id);
}
private function getModelRow($dataRow) {
$row = new CmsRow($dataRow, $this->model);
$row->model = $this->model;
return $row;
}
}