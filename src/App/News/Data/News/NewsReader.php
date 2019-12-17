<?php
namespace Nemundo\Process\App\News\Data\News;
class NewsReader extends \Nemundo\Model\Reader\ModelDataReader {
/**
* @var NewsModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new NewsModel();
}
/**
* @return NewsRow[]
*/
public function getData() {
$this->addFieldByModel($this->model);
$this->checkExternal($this->model);
$list = [];
foreach (parent::getData() as $dataRow) {
$row = $this->getModelRow($dataRow);
$list[] = $row;
}
return $list;
}
/**
* @return NewsRow
*/
public function getRow() {
$this->addFieldByModel($this->model);
$this->checkExternal($this->model);
$dataRow = parent::getRow();
$row = $this->getModelRow($dataRow);
return $row;
}
/**
* @return NewsRow
*/
public function getRowById($id) {
return parent::getRowById($id);
}
private function getModelRow($dataRow) {
$row = new NewsRow($dataRow, $this->model);
$row->model = $this->model;
return $row;
}
}