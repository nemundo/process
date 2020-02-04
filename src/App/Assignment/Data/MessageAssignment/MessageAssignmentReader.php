<?php
namespace Nemundo\Process\App\Assignment\Data\MessageAssignment;
class MessageAssignmentReader extends \Nemundo\Model\Reader\ModelDataReader {
/**
* @var MessageAssignmentModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new MessageAssignmentModel();
}
/**
* @return MessageAssignmentRow[]
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
* @return MessageAssignmentRow
*/
public function getRow() {
$dataRow = parent::getRow();
$row = $this->getModelRow($dataRow);
return $row;
}
/**
* @return MessageAssignmentRow
*/
public function getRowById($id) {
return parent::getRowById($id);
}
private function getModelRow($dataRow) {
$row = new MessageAssignmentRow($dataRow, $this->model);
$row->model = $this->model;
return $row;
}
}