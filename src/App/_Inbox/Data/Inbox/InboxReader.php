<?php
namespace Nemundo\Process\App\Inbox\Data\Inbox;
class InboxReader extends \Nemundo\Model\Reader\ModelDataReader {
/**
* @var InboxModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new InboxModel();
}
/**
* @return InboxRow[]
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
* @return InboxRow
*/
public function getRow() {
$dataRow = parent::getRow();
$row = $this->getModelRow($dataRow);
return $row;
}
/**
* @return InboxRow
*/
public function getRowById($id) {
return parent::getRowById($id);
}
private function getModelRow($dataRow) {
$row = new InboxRow($dataRow, $this->model);
$row->model = $this->model;
return $row;
}
}