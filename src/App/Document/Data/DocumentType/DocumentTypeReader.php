<?php
namespace Nemundo\Process\App\Document\Data\DocumentType;
class DocumentTypeReader extends \Nemundo\Model\Reader\ModelDataReader {
/**
* @var DocumentTypeModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new DocumentTypeModel();
}
/**
* @return DocumentTypeRow[]
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
* @return DocumentTypeRow
*/
public function getRow() {
$dataRow = parent::getRow();
$row = $this->getModelRow($dataRow);
return $row;
}
/**
* @return DocumentTypeRow
*/
public function getRowById($id) {
return parent::getRowById($id);
}
private function getModelRow($dataRow) {
$row = new DocumentTypeRow($dataRow, $this->model);
$row->model = $this->model;
return $row;
}
}