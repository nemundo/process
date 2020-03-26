<?php
namespace Nemundo\Process\App\Notification\Data\Category;
class CategoryReader extends \Nemundo\Model\Reader\ModelDataReader {
/**
* @var CategoryModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new CategoryModel();
}
/**
* @return CategoryRow[]
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
* @return CategoryRow
*/
public function getRow() {
$dataRow = parent::getRow();
$row = $this->getModelRow($dataRow);
return $row;
}
/**
* @return CategoryRow
*/
public function getRowById($id) {
return parent::getRowById($id);
}
private function getModelRow($dataRow) {
$row = new CategoryRow($dataRow, $this->model);
$row->model = $this->model;
return $row;
}
}