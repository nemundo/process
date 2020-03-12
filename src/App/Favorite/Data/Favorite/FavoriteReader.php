<?php
namespace Nemundo\Process\App\Favorite\Data\Favorite;
class FavoriteReader extends \Nemundo\Model\Reader\ModelDataReader {
/**
* @var FavoriteModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new FavoriteModel();
}
/**
* @return FavoriteRow[]
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
* @return FavoriteRow
*/
public function getRow() {
$dataRow = parent::getRow();
$row = $this->getModelRow($dataRow);
return $row;
}
/**
* @return FavoriteRow
*/
public function getRowById($id) {
return parent::getRowById($id);
}
private function getModelRow($dataRow) {
$row = new FavoriteRow($dataRow, $this->model);
$row->model = $this->model;
return $row;
}
}