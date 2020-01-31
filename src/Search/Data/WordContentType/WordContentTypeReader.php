<?php
namespace Nemundo\Process\Search\Data\WordContentType;
class WordContentTypeReader extends \Nemundo\Model\Reader\ModelDataReader {
/**
* @var WordContentTypeModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new WordContentTypeModel();
}
/**
* @return WordContentTypeRow[]
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
* @return WordContentTypeRow
*/
public function getRow() {
$this->addFieldByModel($this->model);
$this->checkExternal($this->model);
$dataRow = parent::getRow();
$row = $this->getModelRow($dataRow);
return $row;
}
/**
* @return WordContentTypeRow
*/
public function getRowById($id) {
return parent::getRowById($id);
}
private function getModelRow($dataRow) {
$row = new WordContentTypeRow($dataRow, $this->model);
$row->model = $this->model;
return $row;
}
}