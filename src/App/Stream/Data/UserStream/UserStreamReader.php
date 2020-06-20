<?php
namespace Nemundo\Process\App\Stream\Data\UserStream;
class UserStreamReader extends \Nemundo\Model\Reader\ModelDataReader {
/**
* @var UserStreamModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new UserStreamModel();
}
/**
* @return UserStreamRow[]
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
* @return UserStreamRow
*/
public function getRow() {
$dataRow = parent::getRow();
$row = $this->getModelRow($dataRow);
return $row;
}
/**
* @return UserStreamRow
*/
public function getRowById($id) {
return parent::getRowById($id);
}
private function getModelRow($dataRow) {
$row = new UserStreamRow($dataRow, $this->model);
$row->model = $this->model;
return $row;
}
}