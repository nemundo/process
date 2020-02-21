<?php
namespace Nemundo\Process\App\Contact\Data\Contact;
class ContactReader extends \Nemundo\Model\Reader\ModelDataReader {
/**
* @var ContactModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new ContactModel();
}
/**
* @return ContactRow[]
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
* @return ContactRow
*/
public function getRow() {
$dataRow = parent::getRow();
$row = $this->getModelRow($dataRow);
return $row;
}
/**
* @return ContactRow
*/
public function getRowById($id) {
return parent::getRowById($id);
}
private function getModelRow($dataRow) {
$row = new ContactRow($dataRow, $this->model);
$row->model = $this->model;
return $row;
}
}