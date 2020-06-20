<?php
namespace Nemundo\Process\App\Stream\Data\Stream;
class StreamReader extends \Nemundo\Model\Reader\ModelDataReader {
/**
* @var StreamModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new StreamModel();
}
/**
* @return StreamRow[]
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
* @return StreamRow
*/
public function getRow() {
$dataRow = parent::getRow();
$row = $this->getModelRow($dataRow);
return $row;
}
/**
* @return StreamRow
*/
public function getRowById($id) {
return parent::getRowById($id);
}
private function getModelRow($dataRow) {
$row = new StreamRow($dataRow, $this->model);
$row->model = $this->model;
return $row;
}
}