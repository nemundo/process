<?php
namespace Nemundo\Process\App\Share\Data\Share;
class ShareReader extends \Nemundo\Model\Reader\ModelDataReader {
/**
* @var ShareModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new ShareModel();
}
/**
* @return ShareRow[]
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
* @return ShareRow
*/
public function getRow() {
$dataRow = parent::getRow();
$row = $this->getModelRow($dataRow);
return $row;
}
/**
* @return ShareRow
*/
public function getRowById($id) {
return parent::getRowById($id);
}
private function getModelRow($dataRow) {
$row = new ShareRow($dataRow, $this->model);
$row->model = $this->model;
return $row;
}
}