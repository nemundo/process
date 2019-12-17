<?php
namespace Nemundo\Process\App\Wiki\Data\Wiki;
class WikiReader extends \Nemundo\Model\Reader\ModelDataReader {
/**
* @var WikiModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new WikiModel();
}
/**
* @return WikiRow[]
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
* @return WikiRow
*/
public function getRow() {
$this->addFieldByModel($this->model);
$this->checkExternal($this->model);
$dataRow = parent::getRow();
$row = $this->getModelRow($dataRow);
return $row;
}
/**
* @return WikiRow
*/
public function getRowById($id) {
return parent::getRowById($id);
}
private function getModelRow($dataRow) {
$row = new WikiRow($dataRow, $this->model);
$row->model = $this->model;
return $row;
}
}